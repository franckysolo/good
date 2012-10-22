<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern;
use Good\Gd\Color;
use Good\Gd\Pattern;
use Good\Gd\Pattern\Line;
/** 
 * The dashed rectangle
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 3 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern 
 */
class DashedRectangle extends DashedLine
{
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
			$message = 'You must specified a foreground color to draw dashed rectangle';
			throw new \RuntimeException($message, 500);	
		}
		
		$style = array_merge($this->_backgroundColor, $this->_foregroundColor);
		
		if($this->_thickness > 1) {
			imagesetthickness($this->_resource, $this->_thickness);
		}
		
		imagesetstyle($this->_resource, $style);	
		
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
		
		if(!imagerectangle($this->_resource, $x1, $y1, $x2, $y2, IMG_COLOR_STYLED)) {
			$message = 'Unable to draw line';
			throw new \RuntimeException($message, 500);
		}
	}
}