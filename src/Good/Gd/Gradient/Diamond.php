<?php
/**
 *  Good 1.0
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
 * @filesource Diamond.php
 * @version $Id: $
 * @desc : the diamond gradient
 */
class Diamond extends Diagonal
{
	/**
	 * @param FilledRectangle $pattern
	 */
	public function __construct(FilledRectangle $pattern)
	{
		$this->_pattern = $pattern;
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Gradient::apply()
	 */
	public function apply()
	{
		list($x1, $y1, $x2, $y2) = $this->_pattern->getCoordinates();
		$image = $this->_pattern->getResource();
		$dx = $x2 - $x1;
		$dy = $y2 - $x1;
		$surface = $dx * $dy;
		
		$index = $offset = 1;
		
		for($i = $x1; $i <= $x2; $i+=1) {
			for($j = $y1; $j <= $y2; $j+=1) {
				$a = $i;
				$b = $j;
				$c = $x2 - $i + $x1;
				$d = $y2 - $j + $y1;
				if($this->isContains($a, $b) && $this->isContains($c, $d)) {
					$offset = $surface + $i + $j;
					$color = $this->interpolate($image, $index, $offset);
					imageline($image, $a, $b, $c, $d, $color);
					$index+=1;					
				}
			}
		}
	}
}