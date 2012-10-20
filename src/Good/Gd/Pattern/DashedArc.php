<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Gd\Color;
use Good\Gd\Pattern\DashedEllipse;
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
 * @desc : the dashed arc pattern class
 */
class DashedArc extends DashedEllipse
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
			$message = 'You must specified a foreground color to draw dashed line';
			throw new \RuntimeException($message, 500);	
		}
		
		$style = array_merge($this->_backgroundColor, $this->_foregroundColor);
		
		if($this->_thickness > 1) {
			imagesetthickness($this->_resource, $this->_thickness);
		}
		
		imagesetstyle($this->_resource, $style);
		
		list($x1, $y1, $x2, $y2, $start, $end) = $this->getCoordinates();
		
		if(!imagearc($this->_resource, $x1, $y1, $x2, $y2, $start, $end, IMG_COLOR_STYLED)) {
			$message = 'Unable to draw line';
			throw new \RuntimeException($message, 500);
		}
	}
}