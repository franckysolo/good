<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Codec;
use Good\Gd\Codec;
/**
 *  The bmp class codec
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd\Codec
 * @subpackage 
 */
final class Bmp extends Codec
{

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Codec::encode()
	 */
	public function encode($resource, $filename)
	{
		if(!image2wbmp($resource, $filename)){
			throw new \Exception('Unable to encode the gd resource in bmp format');
		}
	}

	/**
	 * @{inheritdoc}
	 * @see Good\Gd.Codec::getName($includeDot)
	 */
	public function getName($includeDot = false)
	{
		return image_type_to_extension(IMAGETYPE_BMP, $includeDot);
	}

	/**
	 * (non-PHPdoc)
	 * 
	 * @see Good\Gd.Codec::getMimeType()
	 */
	public function getMimeType()
	{
		return image_type_to_mime_type(IMAGETYPE_BMP);
	}
}