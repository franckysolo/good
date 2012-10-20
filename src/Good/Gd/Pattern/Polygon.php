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
 * @filesource Polygon.php
 * @version $Id: $
 * @desc : the polygon pattern class
 */
class Polygon extends Line 
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{		
		$coords = $this->getCoordinates();
		$number = count($coords) / 2;
		
		if($this->_thickness > 1) {
			imagesetthickness($this->_resource, $this->_thickness);
		}
	
		if(!imagepolygon($this->_resource, $coords, $number, $this->getColor())) {
			$message = 'Unable to draw polygon';
			throw new \RuntimeException($message, 500);
		}
	}
}