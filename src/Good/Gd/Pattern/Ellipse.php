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
 * @since 26 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource Ellipse.php
 * @version $Id: $
 * @desc : the ellipse pattern class
 */

class Ellipse extends Line
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
		
		if(!imageellipse($this->_resource, $x1, $y1, $x2, $y2, $this->getColor())) {
			$message = 'Unable to draw ellipse';
			throw new \RuntimeException($message, 500);
		}
	}
}