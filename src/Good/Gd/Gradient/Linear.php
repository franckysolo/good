<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Gradient;
use Good\Gd\Pattern\FilledRectangle;
use Good\Gd\Gradient;

/**
 *  The linear gradient class
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 22 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Gradient
 */
class Linear extends Gradient
{
	/**
	 * The gradient linear vertical direction
	 * 
	 * @access public
	 * @var string
	 */
	const VERTICAL = 'vertical';
	
	/**
	 * The gradient linear horizontal direction
	 * 
	 * @access public
	 * @var string
	 */
	const HORIZONTAL = 'horizontal';
	
	/**
	 * Create a new linear gradient
	 * 
	 * @param FilledRectangle $pattern
	 * @param string $style
	 */
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
			
		if($this->_style == self::HORIZONTAL) {
			$xmin = $x1;
			$ymin = $y1;
			$xmax = $x2;
			$ymax = $y2;
			
		} else if ($this->_style == self::VERTICAL) {
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
	 * Calculate the points values
	 * 
	 * @param integer $i
	 * @param integer $j
	 * @return array
	 */
	public function calculate($i, $j)
	{
		switch($this->_style) {
			
			case self::VERTICAL:
				$x = $i;
				$y = $j;
			break;
				
			case self::HORIZONTAL:
				$x = $i;
				$y = $j;
			break;		
		}
		
		return array($x, $y);
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
				list($x, $y) = $this->calculate($i, $j);
				$color = $this->interpolate($image, $index, $offset);
				imagesetpixel($image, $x, $y, $color);				
				$index++;
			}
		}
	}
}