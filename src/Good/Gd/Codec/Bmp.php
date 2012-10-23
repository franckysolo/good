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
 *  The bmp class codec
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Codec
 */
final class Bmp extends Decoder implements Encodable
{
	/**
	 * Encode gd resource in bmp format
	 * 
	 * @param gd resource $resource
	 * @param string $filename
	 * @see Good\Gd\Codec\Interfaces.Encodable::encode()
	 */
	public function encode($resource, $filename)
	{
		if(!image2wbmp($resource, $filename)){
			throw new \Exception('Unable to encode the gd resource in bmp format');
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
		return image_type_to_extension(IMAGETYPE_BMP, $includeDot);
	}

	/**
	 * Returns mime-type string name
	 * 
	 * @see Good\Gd.Codec::getMimeType()
	 * @see Good\Gd\Codec\Interfaces.Encodable::getMimeType()
	 */
	public function getMimeType()
	{
		return image_type_to_mime_type(IMAGETYPE_BMP);
	}
}