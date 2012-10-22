<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd;
use Good\Gd\Transformation\Merge;
use Good\Gd\Pattern\Fill;
use Good\Gd\Color\Palette;
use Good\Core\View;
/** 
 * The image class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage Gd
 */
class Image
{		
	/**
	 * The layer list contains layers array each layer add a gd resource
	 *  
	 * @access protected
	 * @var LayerList
	 */
	protected $_layerList;
	
	/**
	 * The index key of active layer
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_activeLayerIndex = 0;
	
	/**
	 * The image dimension 
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_canvasSize;
	
	/**
	 * The html attributes
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_htmlAttributes = array('src' => '', 'alt' => __CLASS__);
		
	/**
	 * Import an image and create a Image class with the resource
	 * 
	 * @access public
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
	 * Create a new image
	 * 
	 * @access public
	 * @param integer $width
	 * @param integer $height
	 */
	public function __construct($width = 100, $height = 100)
	{
		$this->setCanvasSize($width, $height);
		$this->_layerList = new LayerList();
	}
	
	/**
	 * Clone an image
	 * 
	 * @access public
	 * @return void
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
	 * Set the image dimension
	 * 
	 * @access public
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
	 * Returns the image dimension
	 * 
	 * @access public
	 * @return array
	 */
	public function getCanvasSize()
	{
		return $this->_canvasSize;
	}
	
	/**
	 * Create a new layer
	 * 
	 * @access public
	 * @param string $name
	 * @param \Good\Gd\Resource $resource
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
	 * Add a new layer to the layer list
	 * 
	 * @access public
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
	
	/**
	 * Remove a specified layer from the list
	 * 
	 * @access public
	 * @param integer $index
	 * @return  \Good\Gd\Layer
	 */
	public function removeLayer($index)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		} 
		
		return $this->_layerList->remove($index);
	}
	
	/**
	 * Returns of a specified layer from the list
	 * 
	 * @access public
	 * @param integer $index
	 * @return \Good\Gd\Layer
	 */
	public function getLayer($index = null)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		} 
		
		return $this->_layerList->get($index);
	}
	
	/**
	 * Set a specified layer on the list
	 * 
	 * @access public
	 * @param Layer $layer
	 * @param integer $index
	 * @return boolean
	 */
	public function setLayer(Layer $layer, $index = null)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		}
	
		return $this->_layerList->set($index, $layer);
	}
	
	/**
	 * Set the layer list
	 * 
	 * @access public
	 * @param LayerList $layerlist
	 * @return \Good\Gd\Image
	 */
	public function setLayerList(LayerList $layerlist)
	{
		$this->_layerList = $layerlist;	
		return $this;
	}
	
	/**
	 * Set the visibility of a specified layer
	 * 
	 * @access public
	 * @param integer $transparence
	 * @param integer $index
	 * @return \Good\Gd\Image
	 */
	public function setLayerVisibility($transparence, $index = null)
	{
		if(null == $index) {
			$index = $this->_activeLayerIndex;
		}
		
		$layer = $this->_layerList->get($index);
		$layer->setTransparence($transparence);
		
		return $this;
	}
	
	/**
	 * Set the active layer from the layer list
	 * 
	 * @access public
	 * @param integer $index
	 * @throws \InvalidArgumentException
	 * @return \Good\Gd\Image
	 */
	public function setActiveLayerIndex($index)
	{
		if($index < 0 || $index >= $this->_layerList->count()) {
			throw new \InvalidArgumentException($message, 500);
		}
		
		$this->_activeLayerIndex = $index;
		
		return $this;
	}
	
	/**
	 * Returns the layer list
	 * 
	 * @access public
	 * @return \Good\Gd\LayerList
	 */
	public function getLayerList()
	{
		return $this->_layerList;
	}
	
	/**
	 * Save an image
	 * 
	 * @param string $name
	 * @param string $codec
	 * @return \Good\Gd\Image
	 */
	public function save($name = 'image', $codec = Codec::PNG)
	{
		$this->saveAs($name, $codec);
		return $this;
	}
	
	/**
	 * Merge layers, encode & save an image
	 * 
	 * @access public
	 * @param string $name
	 * @param string $codec
	 * @return \Good\Gd\Image
	 */
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
			
			$layer = $this->getLayer(0);
			if($layer->hasFilter()) {
				foreach($layer->getFilters() as $filter) {
					$filter->apply($layer->getResource());
				}
			}
			
			$resource = $layer->getResource();
		}

		$codec->encode($resource, $filename);
		return $this;
	}
	
	/**
	 * Send & encode the image to http header
	 * 
	 * @access public
	 * @param string $codec
	 */
	public function send($codec = Codec::PNG)
	{
		$codec = Codec::factory($codec);
		header('Content-type: ' . $codec->getMimeType());
		$codec->encode($resource->getResource(), null);
	}
	
	/**
	 * Set an html attribute
	 * 
	 * @access public
	 * @param string $name
	 * @param string $value
	 * @return \Good\Gd\Image
	 */
	public function setHtmlAttribute($name, $value)
	{
		$this->_htmlAttributes[(string)$name] = $value;			
		return $this;
	}
	
	/**
	 * Set the image html attributes
	 * 
	 * @access public
	 * @param array $attributes
	 * @return \Good\Gd\Image
	 */
	public function setHtmlAttributes(array $attributes = array())
	{
		foreach($attributes as $name => $value) {
			$this->setHtmlAttribute($name, $value);
		}
		
		return $this;
	}
	
	/**
	 * Returns an html attribute
	 * 
	 * @access public
	 * @param string $name
	 * @return string
	 */
	public function getHtmlAttribute($name)
	{
		if(isset($this->_htmlAttributes[$name])) {
			return $this->_htmlAttributes[$name];
		}
		
		return '';
	}
	
	/**
	 * Returns the image html attributes
	 * 
	 * @access public
	 * @return array
	 */
	public function getHtmlAttributes()
	{
		return $this->_htmlAttributes;
	}
}