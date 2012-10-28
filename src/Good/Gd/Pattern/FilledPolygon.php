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
 * The filled polygon class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern
 */
class FilledPolygon extends FilledRectangle 
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
		
		if(null != $this->_gradient) {
			$this->_gradient->apply();
		}
	}
}