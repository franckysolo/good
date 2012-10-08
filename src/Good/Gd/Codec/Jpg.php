<?php
namespace Good\Gd\Codec;
use Good\Gd\Codec;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Codec
 * @filesource Jpg.php
 * @version $Id: $
 * @desc : the jpg  class codec
 */

class Jpg extends Codec
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
	 * (non-PHPdoc)
	 * @see Good\Gd.Codec::encode()
	 */
	public function encode($resource, $filename)
	{
		if(!imagejpeg($resource, $filename, $this->getQuality())){
			throw new \Exception('Unable to encode the resource on jpeg format');
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Codec::getName()
	 */
	public function getName($includeDot = false)
	{
		return image_type_to_extension(IMAGETYPE_JPEG, $includeDot);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Codec::getMimeType()
	 */
	public function getMimeType()
	{
		return image_type_to_mime_type(IMAGETYPE_JPEG);
	}
}