<?php
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
 * @filesource Arc.php
 * @version $Id: $
 * @desc :
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