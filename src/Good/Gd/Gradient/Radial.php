<?php
namespace Good\Gd\Gradient;
use Good\Gd\Pattern\FilledEllipse;
use Good\Gd\Gradient;
class Radial extends Gradient
{
	public function __construct($pattern, $style = Gradient::HORIZONTAL)
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