<?php
namespace Good\Gd\Pattern;
use Good\Gd\Pattern;
/** *
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource Pixel.php
 * @version $Id: $
 * @desc : the pixel pattern class
 */

class Pixel extends Pattern
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1) = $this->getCoordinates();

		if(!imagesetpixel($this->_resource, $x1, $y1, $this->getColor())) {
			$message = 'Unable to draw pixel';
			throw new \RuntimeException($message, 500);
		}
	}
}