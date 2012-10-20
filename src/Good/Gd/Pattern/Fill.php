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
 * @package
 * @subpackage
 * @filesource Fill.php
 * @version $Id: $
 * @desc :
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