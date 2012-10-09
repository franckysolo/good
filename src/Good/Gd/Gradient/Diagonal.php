<?php
namespace Phpmedias\Graphic\Gd\Gradient;
use Phpmedias\Graphic\Gd\Pattern\FilledRectangle;

use Phpmedias\Graphic\Gd\Gradient;

class Diagonal extends Linear
{

	
	public function adjust()
	{
		list($x1, $y1, $x2, $y2) = $this->_pattern->getCoordinates();
		
		$dx = $x2 - $x1;
		$dy = $y2 - $y1;
		
		$max = $dx * $dy;
	
		return array($x1, $x2, $y1, $y2, $max, $dx, $dy);
	}
	
	public function apply()
	{
		$index = 1;
		$image = $this->_pattern->getResource();
			
		list($background, $color) 	= $this->getColors();
		list($r1, $g1, $b1) 		= $background->getRgba();
		list($r2, $g2, $b2) 		= $color->getRgba();
		
		
		list($xmin, $xmax, $ymin, $ymax, $max, $dx, $dy) = $this->adjust();
		$offset = 1;
		for ($i = $xmin; $i <= $xmax; $i++) {
			for ($j = $ymin; $j <= $ymax; $j++) {
				$offset = $max + $i + $j;
				$x = $i;
				$y = $j;
				$color = $this->interpolate($image, $index, $offset);
				imagesetpixel($image, $x, $y, $color);				
				$index++;
			}
			
		}
	}
}