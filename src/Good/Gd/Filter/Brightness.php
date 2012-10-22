<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/** 
 * The brightness filter class
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @license license.txt
 * @category Good 
 * @package  Good\Gd 
 * @subpackage Filter
 */
class Brightness extends Filter
{
	/**
	 * The brightness of the image
	 * 
	 * @access protected
	 * @var int
	 */
	protected $_brightness = 0;
		
	/**
	 * Set the brightness of the image
	 * 
	 * @access public
	 * @param integer $brightness
	 * @return \Good\Gd\Filter\Brightness
	 */
	public function setBrightness($brightness)
	{
		if($brightness < -255 or $brightness > 255) {
			$brightness = 0;
		}
		
		$this->_brightness = (int)$brightness;
		
		return $this;
	}
	
	/**
	 * Get the brightness of the layer
	 * 
	 * @access public
	 * @return integer
	 */
	public function getBrightness()
	{
		return $this->_brightness;
	}
	
	/**
	 * (non-PHPdoc)
	 * {@inheritdoc}
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		
		if(!imagefilter($resource, IMG_FILTER_BRIGHTNESS, $this->getBrightness())) {
			throw \RuntimeException('Unable to apply brigthness filter');
		}		
	}
}