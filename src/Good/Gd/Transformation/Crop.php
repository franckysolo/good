<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Transformation;
use Good\Gd\Color\Palette;
use Good\Gd\Layer;
use Good\Gd\Resource;
use Good\Gd\Transformation;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 29 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Transformation
 * @filesource Crop.php
 * @version $Id: $
 * @desc : the crop transformation class
 */
class Crop extends Transformation
{
	/**
	 * The box crop dimension
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_box = array();
	
	/**
	 * The crop position
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_position = array();
	
	/**
	 * Get the crop position
	 * 
	 * @access public
	 * @return array
	 */
	public function getPosition()
	{
		if(empty($this->_position)) {
			$this->setPosition(1, 1);
		}
		
		return $this->_position;
	}
	
	/**
	 * Set the crop position
	 * 
	 * @access public
	 * @param integer $x
	 * @param integer $y
	 * @return \Good\Gd\Transformation\Crop
	 */
	public function setPosition($x, $y)
	{
		if($x == 0) {
			$x = 1;
		}
		
		if($y == 0) {
			$y = 1;
		}
		
		$this->_position = 	array($x, $y);		
		return $this;		
	}
	
	/**
	 * Set the box crop dimension
	 * 
	 * @access public
	 * @param integer $width
	 * @param integer $height
	 * @return \Good\Gd\Transformation\Crop
	 */
	public function setBox($width, $height)
	{
		$this->_box = 	array($width, $height);
		return $this;
	}
	
	/**
	 * Returns the box crop array dimension
	 * 
	 * @access public
	 * @return array
	 */
	public function getBox()
	{
		return $this->_box;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Transformation::execute()
	 */
	public function execute()
	{
		$w = imagesx($this->_resource);
		$h = imagesy($this->_resource);
 		list($x, $y) = $this->getPosition();
 		list($a, $b) = $this->getBox();
		$copy = new Resource($a, $b);
		imagecopyresampled($copy->getGd(), $this->_resource, 0, 0, $x, $y, $a, $b, $a, $b);				
		$layer = new Layer('crop-' . uniqid(), $copy);		
		return $layer;
	}
}