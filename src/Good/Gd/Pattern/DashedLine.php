<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Gd\Color;
use Good\Gd\Pattern\Line;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 3 oct. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource DashedLine.php
 * @version $Id: $
 * @desc : the dashed line pattern class
 */
class DashedLine extends Line
{
	/**
	 * The background color
	 * 
	 * @access protected
	 * @var mixed array | null
	 */
	protected $_backgroundColor = null;
	
	/**
	 * The foreground color
	 * 
	 * @access protected
	 * @var mixed array | null
	 */
	protected $_foregroundColor = array();
	
	/**
	 * Set the background color
	 * 
	 * @access public
	 * @param string | integer $color
	 * @param integer $number
	 * @return \Good\Gd\Pattern\DashedLine
	 */
	public function setBackgroundColor($color, $number = 5)
	{
		$backgroundColor = new Color($color);
		$backgroundColor->allocate($this->_resource);
		$index = $backgroundColor->getIndex();
		for($i = 0; $i < $number; $i++) {
			$this->_backgroundColor[] = $index;
		}
		return $this;
	}
	
	/**
	 * Set the foreground color
	 * 
	 * @access public
	 * @param string | integer $color
	 * @param integer $number
	 * @return \Good\Gd\Pattern\DashedLine
	 */
	public function setForegroundColor($color, $number = 5)
	{
		$foregroundColor = new Color($color);
		$foregroundColor->allocate($this->_resource);
		$index = $foregroundColor->getIndex();
		for($i = 0; $i < $number; $i++) {
			$this->_foregroundColor[] = $index;
		}
		
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd\Pattern.Line::draw()
	 */
	public function draw()
	{
		if(null == $this->_backgroundColor) {
			$this->setBackgroundColor($this->getColor());
		}
		
		if(null == $this->_foregroundColor) {
			$message = 'You must specified a foreground color to draw dashed line';
			throw new \RuntimeException($message, 500);	
		}
		
		$style = array_merge($this->_backgroundColor, $this->_foregroundColor);
		
		if($this->_thickness > 1) {
			imagesetthickness($this->_resource, $this->_thickness);
		}
		
		imagesetstyle($this->_resource, $style);
		
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
		
		if(!imageline($this->_resource, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED)) {
			$message = 'Unable to draw line';
			throw new \RuntimeException($message, 500);
		}
	}
}