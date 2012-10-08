<?php
namespace Good\Gd;
use Good\Gd\Transformation\Merge;
use Good\Gd\Pattern\Fill;
use Good\Gd\Color\Palette;
use Good\Core\View;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage 
 * @filesource Image.php
 * @version $Id: $
 * @desc : the image class
 */
class Image
{		
	/**
	 * 
	 * @var LayerList
	 */
	protected $_layerList;
	
	/**
	 * 
	 * @var integer
	 */
	protected $_activeLayerIndex = 0;
	
	/**
	 * 
	 * @var array
	 */
	protected $_canvasSize;
	
	/**
	 * 
	 * @var array
	 */
	protected $_htmlAttributes = array('src' => '', 'alt' => __CLASS__);
		
	/**
	 * 
	 * @param string $filename
	 * @return \Good\Gd\Image
	 */
	public static function import($filename)
	{	
		if(!file_exists($filename)) {
			$message = sprintf('File %s does not exist', $filename);
			throw new \InvalidArgumentException($message, 500);		
		}	
		
		$finfo = getimagesize($filename);		
		$mime = $finfo['mime'];		
		list($width, $height) = $finfo;
		
		$codec = Codec::factory($mime);			
		$gd = $codec->decode($filename);
		
		$name = pathinfo($filename, PATHINFO_FILENAME) . '-copy';
		
		$image = new Image();
		$image->newLayer($name, new Resource($width, $height, $gd));
		
		return $image;
	}
	
	/**
	 * 
	 * @param integer $width
	 * @param integer $height
	 */
	public function __construct($width = 100, $height = 100)
	{
		$this->setCanvasSize($width, $height);
		$this->_layerList = new LayerList();
	}
	
	/**
	 * 
	 */
	public function __clone()
	{
		$oldList = $this->_layerList;
		
		foreach ($oldList as $key => $layer) {
			$clone = clone $layer->get($key);
			$this->_layerList->add($clone);
		}
		
		$this->_canvasSize = clone $this->_canvasSize;	
	}
	
	/**
	 * 
	 * @param integer $width
	 * @param integer $height
	 * @return \Good\Gd\Image
	 */
	public function setCanvasSize($width, $height)
	{
		$this->_canvasSize = array($width, $height);
		return $this;
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getCanvasSize()
	{
		return $this->_canvasSize;
	}
	
	/**
	 * 
	 * @param string $name
	 * @param Resource $resource
	 * @throws \BadMethodCallException
	 * @return \Good\Gd\Layer
	 */
	public function newLayer($name = 'layer-1', Resource $resource = null)
	{	
		if($this->_layerList->count() > 1) {
			$message = 'Default layer is already defined, use addLayer() method instead';
			throw new \BadMethodCallException($message, 500);
		}
		
		if(null == $resource) {
			list($width, $height) = $this->getCanvasSize();
			$resource = new Resource($width, $height);
		}	
		
		$layer = new Layer($name, $resource);
		
		$this->_layerList->add($layer);
		
		return $layer;
	}
	
	/**
	 * 
	 * @param string $name
	 * @param Layer $layer
	 * @param string $color
	 * @throws \BadMethodCallException
	 * @return \Good\Gd\Layer
	 */
	public function addLayer($name, Layer $layer = null, $color = Palette::TRANSPARENT)
	{	
		if($this->_layerList->count() == 0) {
			$message = 'No default layer is defined, use newLayer() method instead';
			throw new \BadMethodCallException($message, 500);
		}
		
		if(null == $layer) {
			//@bug			
			//$resource = clone $this->getLayer($this->_activeLayerIndex)->getClassResource();
			//$layer = new Layer($name, $resource, $color);
				
			$ls = $this->getLayer($this->_activeLayerIndex)->getResource();
			$w = imagesx($ls);
			$h = imagesx($ls);
			$resource = new Resource($w, $h);
			$layer = new Layer($name, $resource, $color);
		}
			
		$this->_layerList->add($layer);	
		$this->_activeLayerIndex = $this->_layerList->count() - 1;
			
		return $this->_layerList->get($this->_activeLayerIndex);	
	}
	
	public function removeLayer($index)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		} 
		
		return $this->_layerList->remove($index);
	}
	
	public function getLayer($index = null)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		} 
		
		return $this->_layerList->get($index);
	}
	
	public function setLayer(Layer $layer, $index = null)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		}
	
		return $this->_layerList->set($index, $layer);
	}
	
	public function setLayerList(LayerList $layerlist)
	{
		$this->_layerList = $layerlist;	
		return $this;
	}
	
	public function setLayerVisibility($transparence, $index = null)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		}
		
		$layer = $this->_layerList->get($index);
		$layer->setTransparence($transparence);
		
		return $this;
	}
	
	public function setActiveLayerIndex($index)
	{
		if($index < 0 || $index >= $this->_layerList->count()) {
			throw new \InvalidArgumentException($message, 500);
		}
		
		$this->_activeLayerIndex = $index;
		
		return $this;
	}
	
	public function getLayerList()
	{
		return $this->_layerList;
	}
	
	public function save($name = 'image', $codec = Codec::PNG)
	{
		$this->saveAs($name, $codec);
		return $this;
	}
	
	public function saveAs($name, $codec)
	{
		$codec = Codec::factory($codec);
		$filename = $name . $codec->getName(true);
		$this->setHtmlAttribute('src', $filename);	
		
		if($this->_layerList->count() > 1){
			$merge = new Merge($this->getLayer(0)->getResource());
			$merge->addLayerList($this->_layerList);
			$layer = $merge->execute();
			$resource = $layer->getResource();		
		} else { 
			$resource = $this->getLayer(0)->getResource();
		}

		$codec->encode($resource, $filename);
		return $this;
	}
	
	public function send($codec = Codec::PNG)
	{
		$codec = Codec::factory($codec);
		header('Content-type: ' . $codec->getMimeType());
		$codec->encode($resource->getResource(), null);
	}
	
	public function setHtmlAttribute($name, $value)
	{
		$this->_htmlAttributes[(string)$name] = $value;			
		return $this;
	}
	
	public function setHtmlAttributes(array $attributes = array())
	{
		foreach($attributes as $name => $value) {
			$this->setHtmlAttribute($name, $value);
		}
		
		return $this;
	}
	
	public function getHtmlAttribute($name)
	{
		if(isset($this->_htmlAttributes[$name])) {
			return $this->_htmlAttributes[$name];
		}
		
		return '';
	}
	
	public function getHtmlAttributes()
	{
		return $this->_htmlAttributes;
	}
}