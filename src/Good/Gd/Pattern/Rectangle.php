<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource Rectangle.php
 * @version $Id: $
 * @desc : the rectangle pattern class
 */
class Rectangle extends Line 
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{		
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
		
		if($this->_thickness > 1) {
			imagesetthickness($this->_resource, $this->_thickness);
		}
		
		if(!imagerectangle($this->_resource, $x1, $y1, $x2, $y2, $this->getColor())) {
			$message = 'Unable to draw rectangle';
			throw new \RuntimeException($message, 500);
		}
	}
}