<?php
namespace Good\Gd\Gradient;
use Good\Gd\Pattern\FilledRectangle;

use Good\Gd\Gradient;

class Linear extends Gradient
{
	public function __construct(FilledRectangle $pattern, $style = self::HORIZONTAL)
	{
		$this->_pattern = $pattern;
		$this->_style  = $style;
	}
	/**
	 * Adjust points for gradient
	 *
	 * @access public
	 * @return multitype:unknown number
	 */
	public function adjust()
	{
		list($x1, $y1, $x2, $y2) = $this->_pattern->getCoordinates();
			
		if($this->_style == Gradient::HORIZONTAL) {
			$xmin = $x1;
			$ymin = $y1;
			$xmax = $x2;
			$ymax = $y2;
			
		} else {
			$xmin = $y1;
			$ymin = $x1;
			$xmax = $y2;
			$ymax = $x2;			
		}
		
		$dx = $xmax - $xmin;
		$dy = $ymax - $ymin;
		
		$max = $dx * $dy;
	
		return array($xmin, $xmax, $ymin, $ymax, $max);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Gradient::apply()
	 */
	public function apply()
	{
		$index = 1;
		$image = $this->_pattern->getResource();
			
		list($background, $color) 	= $this->getColors();
		list($r1, $g1, $b1) 		= $background->getRgba();
		list($r2, $g2, $b2) 		= $color->getRgba();
		
		
		list($xmin, $xmax, $ymin, $ymax, $max) = $this->adjust();

		for ($i = $xmin; $i <= $xmax; $i++) {
			for ($j = $ymin; $j <= $ymax; $j++) {	
				$offset = $max + $j + $i;
				$x = ($this->_style == Gradient::HORIZONTAL) ? $i : $j;
				$y = ($this->_style == Gradient::HORIZONTAL) ? $j : $i;
				$color = $this->interpolate($image, $index, $offset);
				imagesetpixel($image, $x, $y, $color);				
				$index++;
			}
		}
	}
}