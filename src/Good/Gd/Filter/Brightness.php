<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd 
 * @subpackage Filter
 * @filesource Brightness.php
 * @version $Id: $
 * @desc :
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
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		
		if(!imagefilter($resource, IMG_FILTER_BRIGHTNESS, $this->getBrightness())) {
			throw \RuntimeException('Unable to apply brigthness filter');
		}		
	}
}