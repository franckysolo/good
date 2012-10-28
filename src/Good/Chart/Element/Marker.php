<?php
namespace Good\Chart\Element;
use Good\Gd\Resource;

use Good\Gd\Layer;

use Good\Gd\LayerList;
use Good\Gd\Image;
use Good\Gd\Transformation\Merge;

use Good\Gd\Pattern\Line;

class Marker extends Line
{
	/**
	 *
	 * @access protected
	 * @var integer
	 */
	const CROSS = 0;
	
	/**
	 *
	 * @access protected
	 * @var integer
	 */
	const ADD = 1;
	
	const ICON = 2;
	
	/**
	 *
	 * @access protected
	 * @var string
	 */
	protected $_type = self::ICON;
	
	/**
	 *
	 * @access public
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->_type = (string)$type;
		return $this;
	}
	
	public function setIcon($filename = 'icon.png')
	{
		if(!file_exists($filename)) {
			$message = sprintf('Unable to load file icon %s', $filename);
			throw new \InvalidArgumentException($message, 500);
		}
		
		$this->_icon = imagecreatefromstring(file_get_contents($filename));
		return $this;
	}
	
	/**
	 *
	 * @access public
	 * @return string
	 */
	public function getType()
	{
		return $this->_type;
	}
	
	
	public function draw()
	{
		list($x, $y) = $this->getCoordinates();
	
		if($this->_type == self::CROSS) {
			$this->setCoordinates($x + 2, $y + 2, $x - 2, $y - 2);
			parent::draw();
			$this->setCoordinates($x + 2, $y - 2, $x - 2, $y + 2);
			parent::draw();
		} else if($this->_type == self::ADD) {
			//@todo
		} else if($this->_type == self::ICON) {
			/**
			//@todo wait for modified & test Layer class to add position layer x & y
			$icon = Image::import('icon.png');
			$layerIcon = $icon->getLayer();
			$layerIcon->setCoordinates($x - $layerIcon->getWidth() / 2, $y - $layerIcon->getHeight());
			
			$merge = new Merge($this->_resource);
			$layerList = new LayerList(array($layerIcon));
			$merge->addLayerList($layerList)->execute();
			//////////////////////////////////////////////////////
			*/
			if(null == $this->_icon) {
				throw new \RuntimeException('Image icon resource is not defined', 500);
			}
			// simple version
			$w = imagesx($this->_icon);
			$h = imagesy($this->_icon);
			imagecopymerge($this->_resource, $this->_icon,  $x - $w / 2, $y - $h / 2, 0, 0, $w, $h, 100);
		
		} else {
			$this->setCoordinates($x, $y, $x, $y);
			parent::draw();
		}
	}
}