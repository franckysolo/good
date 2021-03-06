<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Codec;
use Good\Gd\Codec\Interfaces\Encodable;

use Good\Gd\Codec;
/**
 * The png class codec
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Codec
 */
final class Png extends Decoder implements Encodable
{
	/**
	 * Some png codec constants
	 *
	 * @access public
	 * @var integer
	 */
	const NO_FILTER      = PNG_NO_FILTER;
	const FILTER_NONE    = PNG_FILTER_NONE;
	const FILTER_SUB     = PNG_FILTER_SUB;
	const FILTER_UP      = PNG_FILTER_UP;
	const FILTER_AVG     = PNG_FILTER_AVG;
	const FILTER_PAETH   = PNG_FILTER_PAETH;
	const ALL_FILTERS    = PNG_ALL_FILTERS;

	/**
	 * The png quality
	 *
	 * @access private
	 * @var integer
	 */
	private $_quality = 9;

	/**
	 * The png filter
	 *
	 * @access private
	 * @var integer
	 */
	private $_filter = self::ALL_FILTERS;

	/**
	 * Create a new png codec
	 *
	 * @access public
	 * @param array $options
	 */
	public function __construct($options = null)
	{
		if(null !== $options){
			if(isset($options['quality']) and null !== $options['quality']){
				$this->_quality = $options['quality'];
			}

			if(isset($options['filters']) and null !== $options['filters']){
				$this->_filter = $options['filters'];
			}
		}
	}

	/**
	 * Encode gd resource in png format
	 * 
	 * @param gd resource $resource
	 * @param string $filename
	 * @see Good\Gd\Codec\Interfaces.Encodable::encode()
	 */
	public function encode($resource, $filename)
	{
		if(!imagepng($resource, $filename, $this->_quality, $this->_filter)){
			throw new \Exception('Unable to encode the gd resource in png format');
		}
	}

	/**
	 * Set the png filter constant
	 *
	 * @access public
	 * @param integer $filter
	 * @return \Good\Gd\Codec\Png
	 */
	public function setFilter($filter)
	{
		$validFilters = self::NO_FILTER | self::FILTER_NONE | self::FILTER_SUB | self::FILTER_UP
		| self::FILTER_AVG | self::FILTER_PAETH | self::ALL_FILTERS;
			
		$filter = $filter & $validFilters;

		$this->_filter = (int)$filter;
		return $this;
	}

	/**
	 * Get the png filter constant
	 *
	 * @access public
	 * @return integer
	 */
	public function getFilter()
	{
		return $this->_filter;
	}

	/**
	 * Set the png quality
	 *
	 * @access public
	 * @param integer $quality
	 * @return \Good\Gd\Codec\Png
	 */
	public function setQuality($quality)
	{
		if(null == $quality or $quality < 0 or $quality > 10) {
			$quality = 9;
		}

		$this->_quality = (int)$quality;

		return $this;
	}

	/**
	 * Get the png quality
	 *
	 * @access public
	 * @return integer
	 */
	public function getQuality()
	{
		return $this->_quality;
	}

	/**
	 * Returns extension string name
	 * 
	 * @param boolean $includeDot
	 * @see Good\Gd\Codec\Interfaces.Encodable::getName()
	 */
	public function getName($includeDot = false)
	{
		return image_type_to_extension(IMAGETYPE_PNG, $includeDot);
	}

	/**
	 * Returns mime-type string name
	 * 
	 * @see Good\Gd\Codec\Interfaces.Encodable::getMimeType()
	 */
	public function getMimeType() {
		return image_type_to_mime_type(IMAGETYPE_PNG);
	}
}