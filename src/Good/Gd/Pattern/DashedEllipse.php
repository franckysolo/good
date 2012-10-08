<?php
namespace Good\Gd\Pattern;
use Good\Gd\Color;
use Good\Gd\Pattern;
use Good\Gd\Pattern\Line;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 3 oct. 2012
 * @license license.txt
 * @category Good 
 * @package
 * @subpackage
 * @filesource DashedLine.php
 * @version $Id: $
 * @desc :
 */
class DashedEllipse extends Ellipse
{
	protected $_backgroundColor = null;
	
	protected $_foregroundColor = array();
	
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
		
		list($cx, $cy, $w, $h) = $this->getCoordinates();
		
		if(!imageellipse($this->_resource, $cx, $cy, $w, $h, IMG_COLOR_STYLED)) {
			$message = 'Unable to draw line';
			throw new \RuntimeException($message, 500);
		}
	}
}