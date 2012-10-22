<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Gradient;
use Good\Gd\Pattern\FilledRectangle;
use Good\Gd\Gradient;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 22 oct. 2012
 * @license license.txt
 * @category Good
 * @package Gd
 * @subpackage Gradient
 * @filesource Diagonal.php
 * @version $Id: $
 * @desc :
 */
class Diagonal extends Linear
{
	/**
	 * Obliqe style 45° scope
	 * 
	 * @var integer
	 */
	const OBLIQUE = 'oblique';
	
	/**
	 * Symetric wave
	 * 
	 * @var integer
	 */
	const SYMETRIC = 'symetric';
	
	/**
	 * Create a new diagonal gradient
	 * 
	 * @param FilledRectangle $pattern
	 * @param string $style
	 */
	public function __construct(FilledRectangle $pattern, $style = self::OBLIQUE) {
		parent::__construct($pattern, $style);
	}

	/**
	 * Check if point is contains on rectangle
	 * 
	 * @param float | integer $x
	 * @param float | integer $y
	 * @return boolean
	 */
	public function isContains($x, $y)
	{
		list($x1, $y1, $x2, $y2) = $this->_pattern->getCoordinates();
		if($x >= $x1  && $x <= $x2 && $y >= $y1 && $y <= $y2) {
			return true;
		}
		return false;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd\Gradient.Linear::apply()
	 */
	public function apply()
	{
		$index = 1;
		$image = $this->_pattern->getResource();
			
		list($background, $color) 	= $this->getColors();
		list($r1, $g1, $b1) 		= $background->getRgba();
		list($r2, $g2, $b2) 		= $color->getRgba();		
		list($xmin, $ymin, $xmax, $ymax) = $this->_pattern->getCoordinates();

		$dx = $xmax - $xmin;
		$dy = $ymax - $ymin;
		
		$max = $dx * $dy;
		
		$offset = 1;
		//@FIXME change Symetric yo reverse oblique
		for ($i = $xmin; $i <= $xmax; $i++) {
			for ($j = $ymin ; $j <= $ymax; $j++) {
				$a = ($this->_style == self::OBLIQUE) ? $i : $xmax - $i + $xmin;
				$b = ($this->_style == self::OBLIQUE) ? $j : $ymax - $j + $ymin;
				$c = ($this->_style == self::OBLIQUE) ? $xmin - $j + $i : $i;
				$d = ($this->_style == self::OBLIQUE) ? $j : $ymax + $i - $j;
				if($this->isContains($a, $b) && $this->isContains($c, $d)) {
					$offset = $max + $i + $j;
					$color = $this->interpolate($image, $index, $offset);
					imageline($image, $a, $b , $c,  $d, $color);
					$index += (self::OBLIQUE) ? 1 : 2;					
				}
			}			
		}
	}
}