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
 * The fill class pattern
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern
 */
class Fill extends Pattern 
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{		
		list($x1, $y1) = $this->getCoordinates();
				
		if(!imagefill($this->_resource, $x1, $y1, $this->getColor())) {
			$message = 'Unable to fill image';
			throw new \RuntimeException($message, 500);
		}
	}
}