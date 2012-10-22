<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd;
/**
 *  The color class
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage Gd 
 */
class Color
{	
	/**
	 * The red channel from 0 to 255
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_red;
	
	/**
	 * The blue channel from 0 to 255
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_blue;
	
	/**
	 * The blue channel from 0 to 255
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_green;
	
	/**
	 * The alpha channel from 0 to 127
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_alpha;
	
	/**
	 * The resource
	 *
	 * @access protected
	 * @var gd resource
	 */
	protected $_resource = null;
	
	/**
	 * The color index allocation
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_index;
	
	/**
	 * Create a new color
	 *
	 * @access public
	 * @param mixed (integer | string | array | arguments) $arguments
	 */
	public function __construct($arguments = null)
	{
		if(null == $arguments) {
			$arguments = array(0, 0, 0);
		}
	
		if(!is_array($arguments)) {
			if(is_string($arguments)) {
				$arguments = $this->setRgbaFromString($arguments);
			} else if (is_int($arguments)) {
				$arguments = $this->setRgbaFromInteger($arguments);				
			} else {
				$arguments = func_get_args();
			}
		}
	
		$this->setRgba($arguments);
	}
	
	/**
	 * Set the rgba colors
	 *
	 * @access public
	 * @param array $colors
	 * @throws \InvalidArgumentException
	 * @return \Good\Gd\Color
	 */
	public function setRgba(array $colors = array()) {
	
		$count = count($colors);
	
		if($count == 3) {
			$alpha = 0;
			list($red, $green, $blue) = $colors;
		} else if($count == 4) {
			list($red, $green, $blue, $alpha) = $colors;
		} else {
			throw new \InvalidArgumentException('3 parameters expected for rgb color, 4 for rgba color', 400);
		}
	
		$this->setRed($red);
		$this->setGreen($green);
		$this->setBlue($blue);
		$this->setAlpha($alpha);
	
		return $this;
	}
	
	/**
	 * Set the the rgba colors from string parameters
	 *
	 * @access public
	 * @param string $stringColor
	 * @return array
	 */
	public function setRgbaFromString($stringColor)
	{	
		if(strpos($stringColor, '#') !== false) {
			ltrim($stringColor, '#');
		}
	
		$red 	= hexdec(substr($stringColor, 0, 2));
		$green 	= hexdec(substr($stringColor, 2, 2));
		$blue 	= hexdec(substr($stringColor, 4, 2));
		$alpha 	= (strlen($stringColor) == 8) ? hexdec(substr($stringColor, 6, 2)) : 0;
		
		return array($red, $green, $blue, $alpha);
	}
	
	/**
	 * Set the the rgba colors from integer parameter
	 *
	 * @access public
	 * @param integer $integer
	 * @return array
	 */	
	public function setRgbaFromInteger($integer)
	{	
		$red 	= ($integer >> 16) & 0xff;
		$green 	= ($integer >> 8) & 0xff;
		$blue 	= ($integer) & 0xff;
		$alpha 	= ($integer >> 24 )& 0xff;
				
		return array($red, $green, $blue, $alpha);
	}
	
	/**
	 * Get the rgba color array
	 *
	 * @access public
	 * @return array
	 */
	public function getRgba()
	{
		return array(
			$this->_red, $this->_green, $this->_blue, $this->_alpha
		);
	}
	
	/**
	 * Set the red channel
	 *
	 * @access public
	 * @param integer $red
	 * @return \Good\Gd\Color
	 */
	public function setRed($red)
	{
		if($red < 0 or $red > 255){
			$red = 127;
		}
	
		$this->_red = (int)$red;
	
		return $this;
	}
	
	/**
	 * Get the red channel
	 *
	 * @access public
	 * @return integer
	 */
	public function getRed()
	{
		return $this->_red;
	}
	
	/**
	 * Set the blue channel
	 *
	 * @access public
	 * @param integer $blue
	 * @return \Good\Gd\Color
	 */
	public function setBlue($blue)
	{
		if($blue < 0 or $blue > 255){
			$blue = 127;
		}
	
		$this->_blue = (int)$blue;
	
		return $this;
	}
	
	/**
	 * Get the blue channel
	 *
	 * @access public
	 * @return integer
	 */
	public function getBlue()
	{
		return $this->_blue;
	}
	
	/**
	 * Set the green channel
	 *
	 * @access public
	 * @param integer $green
	 * @return \Good\Gd\Color
	 */
	public function setGreen($green)
	{
		if($green < 0 or $green > 255){
			$green = 127;
		}
	
		$this->_green = (int)$green;
	
		return $this;
	}
	
	/**
	 * Get the green channel
	 *
	 * @access public
	 * @return integer
	 */
	public function getGreen()
	{
		return $this->_green;
	}
	
	/**
	 * Set the alpha channel
	 *
	 * @access public
	 * @param integer $alpha
	 * @return \Good\Gd\Color
	 */
	public function setAlpha($alpha)
	{
		if($alpha < 0 or $alpha > 127){
			$alpha = 127;
		}
	
		$this->_alpha = (int)$alpha;
	
		return $this;
	}
	
	/**
	 * Get the alpha channel
	 * 
	 * @access public
	 * @return integer
	 */
	public function getAlpha()
	{
		return $this->_alpha;
	}
	
	/**
	 * Allocate the gd color
	 *
	 * @access public
	 * @param gd resource $resource
	 * @throws \RuntimeException
	 * @return \Good\Gd\Color
	 */
	public function allocate($resource)
	{
		if($this->_alpha == 0) {
			$index = imagecolorallocate($resource, $this->_red, $this->_green, $this->_blue);
		} else {
			$index = imagecolorallocatealpha($resource, $this->_red, $this->_green, $this->_blue, $this->_alpha);
		}
	
		if(false === $index) {
			throw new \RuntimeException('Unable to allocate color', 500);
		}
	
		$this->_index = $index;
		$this->_resource = $resource;

		return $this;
	}
	
	/**
	 * Get the index color allocation
	 *
	 * @access public
	 * @return integer
	 */
	public function getIndex()
	{
		return $this->_index;
	}
	
	/**
	 * Unset colors allocation
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct()
	{
		if(false !== $this->_index and is_resource($this->_resource)) {
			imagecolordeallocate($this->_resource, $this->_index);
		}
	}
}