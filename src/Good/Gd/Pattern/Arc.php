<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern\Line;
/** 
 *  The arc pattern class
 *  This class is used to draw an arc plot
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern
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