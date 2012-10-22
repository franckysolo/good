<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Color;
/** 
 *  The palette color class
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Color
 */
class Palette 
{
	/**
	 * Some palette constante
	 * 
	 * @access public
	 * @var integer
	 */
	const TRANSPARENT 	= 0x7fffffff;
	const WHITE 	  	= 0xffffff;
	const LIGHTGRAY 	= 0xececec;
	const DARKGRAY 		= 0x666666;
	const SILVER 		= 0xc0c0c0;
	const GRAY 			= 0x999999;
	const MAROON		= 0x800000;
	const BLUE 			= 0x0000ff;	
	const PURPLE 		= 0x800080;
	const FUSHIA		= 0xff00ff;
	const NAVY			= 0x000080;
	const AQUA			= 0x00ffff;
	const TEAL			= 0x008080;
	const RED 			= 0xff0000;
	const LIME 			= 0x00ff00;
	const GREEN 		= 0x008000;
	const OLIVE 		= 0x808000;
	const YELLOW 		= 0x00ffff;
	const ORANGE 		= 0xffcc00;	
	const BLACK 	  	= 0x000000;
	
	/**
	 * The pallette colors
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_colors = array();
	
	/**
	 * Set the colors
	 * 
	 * @access public
	 * @param array $colors
	 * @throws \InvalidArgumentException
	 * @return \Good\Gd\Color\Palette
	 */
	public function setColors(array $colors = array())
	{
		foreach($colors as $key => $color) {
			if(!is_string($name)) {
				$message = 'String expected for color key';
				throw new \InvalidArgumentException($message, 500);
			}
			
			$this->_colors[(string)$key] = $color;
		}
		
		return $this;
	}
	
	/**
	 * Returns the palette colors array
	 * 
	 * @access public
	 * @return array
	 */
	public function getColors()
	{
		return $this->_colors;
	}
	
	/**
	 * Set random colors array pair key (value in hexa) value (value in integer)
	 * 
	 * @access public
	 * @param integer $numberOfColor
	 * @param boolean $randomAlpha
	 * @return array  
	 */
	public function randomColor($numberOfColor, $randomAlpha = false)
	{
		$colors = array();
	
		for($i = 0; $i < $numberOfColor; ++$i) {
				
			$red 	= mt_rand(0, 255);
			$green 	= mt_rand(0, 255);
			$blue 	= mt_rand(0, 255);
			$color 	= array($red, $green, $blue);
			
			if($randomAlpha) {
				$alpha 	=  mt_rand(0, 127);
				array_push($color, $alpha);
			}
						
			$key = $this->rgbaToHtml($color);
			$colors[$key] = $color;		
		}
		
		return $colors;
	}
	
	/**
	 * Convert rgb value tohtml format
	 * 
	 * @access public
	 * @param array $colors
	 * @return string
	 */
	public function rgbaToHtml(array $colors = array())
	{
		$html = '#';
		foreach ($colors as $value) {
			$html .= $this->rgbToHexa($value);
		}
		
		return $html;
	}
	
	/**
	 * Convert rgb value hexadecimal 
	 * 
	 * @access public
	 * @param integer $number
	 * @return string
	 */
	public function rgbToHexa($number)
	{
		if($number < 0) {
			$number = 0;
		} else if ($number > 255) {
			$number = 255;
		}
	
		$html = dechex($number);
		$html = (strlen($html) == 2) ? $html : '0' . $html;
	
		return $html;
	}
	
	/**
	 * Returns a parameter
	 * 
	 * @access public
	 * @param string $name
	 * @return string
	 */
	public function __get($name) {
		if(isset($this->_colors[$name])) {
			return $this->_colors[$name];
		}
		
		return 0;
	}
	
	/**
	 * Set a parameter
	 * 
	 * @access public
	 * @param string $name
	 * @param integer $value
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	public function __set($name, $value) {
		if(!is_string($name)) {
			$message = 'String expected for color key';
			throw new \InvalidArgumentException($message, 500);
		}
			
		$this->_colors[(string)$name] = $value;
	}	
}