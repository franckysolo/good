<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Gradient;
use Good\Gd\Pattern\FilledEllipse;
use Good\Gd\Gradient;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 22 oct. 2012
 * @license license.txt
 * @category Good
 * @package Good\Gd
 * @subpackage Gradient
 * @filesource Radial.php
 * @version $Id: $
 * @desc : the radial gradient
 */
class Radial extends Gradient
{
	/**
	 * Create a new radial gradient
	 * 
	 * @access public
	 * @param Pattern $pattern
	 */
	public function __construct(Pattern $pattern)
	{
		$this->_pattern = $pattern;
		$this->_style  = $style;
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Gradient::apply()
	 */
	public function apply()
	{
		list($cx, $cy, $w, $h) = $this->_pattern->getCoordinates();
		$image = $this->_pattern->getResource();	
		$index = 1;
		$width = $w;
		$height =  $h;	
		$max = $w * $h * M_PI;
		for($i = $w; $i >= 1; $i--) {
			for ($j = $h; $j >= 1; $j--) {
				$offset = $max + $i + $j;
				$color = $this->interpolate($image, $index, $offset);
				imageellipse($image, $cx, $cy, $i, $j, $color);
				$index+=3;
			}
		}
	}
}