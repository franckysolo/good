<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd;
use Good\Gd\Color;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 5 oct. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage
 * @filesource Gradient.php
 * @version $Id: $
 * @desc : the gradient abstract class
 */
abstract class Gradient
{
	/**
	 * The colors of gradient
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_colors = array();
	
	/**
	 * The colors of gradient
	 * 
	 * @access public
	 * @param array $colors
	 * @return \Good\Gd\Effect\Gradient
	 */
	public function setColors($colors)
	{
		foreach($colors as $color) {
			$color = (!$color instanceof Color) ? new Color($color): $color;
			$this->_colors[] = $color;
		}
		return $this;
	}
	
	/**
	 * Get a color gradient
	 *
	 * @access public
	 * @param integer $index
	 * @return Color
	 */
	public function getColor($index)
	{
		if(isset($this->_colors[$index])) {
			return $this->_colors[$index];
		}
	
		return null;
	}
	
	/**
	 * Get colors gradient
	 *
	 * @access public
	 * @return array
	 */
	public function getColors()
	{
		return $this->_colors;
	}
	
	/**
	 * Interpolate color for gradient effect
	 * 
	 * @param gd resource $image
	 * @param integer $index
	 * @param integer $offset
	 * @return integer
	 */
	public function interpolate($image, $index, $offset)
	{
		list($background, $color) = $this->getColors();
		
		list($r1, $g1, $b1) = $background->getRgba();
		list($r2, $g2, $b2) = $color->getRgba();
		
		$red 	= ( $r2 - $r1 != 0 ) ? $r1 + ( $r2 - $r1 ) * ( $index / $offset ) : $r1;
		$green 	= ( $g2 - $g1 != 0 ) ? $g1 + ( $g2 - $g1 ) * ( $index / $offset ) : $g1;
		$blue 	= ( $b2 - $b1 != 0 ) ? $b1 + ( $b2 - $b1 ) * ( $index / $offset ) : $b1;
			
		return imagecolorallocate($image, $red, $green, $blue);
	}
	
	abstract public function apply();
}