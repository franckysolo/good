<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern;
/** 
 * The ellipse pattern class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern
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