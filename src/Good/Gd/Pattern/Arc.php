<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern\Line;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource Arc.php
 * @version $Id: $
 * @desc : this class is used to draw an arc plot
 */

class Arc extends Line
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1, $x2, $y2, $start, $end) = $this->getCoordinates();
		
		if($this->_thickness > 1) {
			imagesetthickness($this->_resource, $this->_thickness);
		}
		
		if(!imagearc($this->_resource, $x1, $y1, $x2, $y2, $start, $end, $this->getColor())) {
			$message = 'Unable to draw filledrectangle';
			throw new \RuntimeException($message, 500);
		}
	}
}