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
 *  The jpg  class codec
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Codec
 */
class Jpg extends Decoder implements Encodable
{
	/**
	 * The jpeg quality
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_quality = 75;
	
	/**
	 * Create a new jpg codec
	 * 
	 * @access public
	 * @param integer $quality
	 */
	public function __construct($quality = null)
	{
		$this->setQuality($quality);
	}
	
	/**
	 * Set the jpeg quality encoding
	 *
	 * @access public
	 * @param integer $quality
	 * @return \Good\Gd\Codec\Jpg
	 */
	public function setQuality($quality)
	{
		if(null == $quality or $quality < 0 or $quality > 100) {
			$quality = 75;
		}
	
		$this->_quality = (int)$quality;
	
		return $this;
	}
	
	/**
	 * Get the jpeg quality encoding
	 *
	 * @access public
	 * @return integer
	 */
	public function getQuality()
	{
		return $this->_quality;
	}
	
	/**
	 * Encode gd resource in jpg format
	 * 
	 * @param gd resource $resource
	 * @param string $filename
	 * @see Good\Gd\Codec\Interfaces.Encodable::encode()
	 */
	public function encode($resource, $filename)
	{
		if(!imagejpeg($resource, $filename, $this->getQuality())){
			throw new \Exception('Unable to encode the resource on jpeg format');
		}
	}
	
	/**
	 * Returns extension string name
	 * 
	 * @param boolean $includeDot
	 * @see Good\Gd\Codec\Interfaces.Encodable::getName()
	 */
	public function getName($includeDot = false)
	{
		return image_type_to_extension(IMAGETYPE_JPEG, $includeDot);
	}
	
	/**
	 * Returns mime-type string name
	 * 
	 * @see Good\Gd\Codec\Interfaces.Encodable::getMimeType()
	 */
	public function getMimeType()
	{
		return image_type_to_mime_type(IMAGETYPE_JPEG);
	}
}