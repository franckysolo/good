<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Gradient;
use Good\Gd\Pattern\FilledEllipse;
use Good\Gd\Gradient;
/**
 * The radial gradient 
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 22 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good
 * @package Good\Gd
 * @subpackage Gradient
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