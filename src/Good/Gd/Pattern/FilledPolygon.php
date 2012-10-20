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
 * @filesource FilledPolygon.php
 * @version $Id: $
 * @desc : the filled polygon class
 */
class FilledPolygon extends Pattern 
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{		
		$coords = $this->getCoordinates();
		$number = count($coords) / 2;
		
		if(!imagefilledpolygon($this->_resource, $coords, $number, $this->getColor())) {
			$message = 'Unable to draw filled polygon';
			throw new \RuntimeException($message, 500);
		}
	}
}