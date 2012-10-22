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
 *  The gif codec class
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good
 * @package Good\Gd
 * @subpackage Codec
 */
final class Gif extends Codec
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Codec::encode()
	 */
	public function encode($resource, $filename)
	{
		if(!imagegif($resource, $filename)){
			throw new \RuntimeException('Unable to encode the gd resource in gif format');
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Codec::getName()
	 */
	public function getName($includeDot = false)
	{
		return image_type_to_extension(IMAGETYPE_GIF, $includeDot);
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Codec::getMimeType()
	 */
	public function getMimeType()
	{
		return image_type_to_mime_type(IMAGETYPE_GIF);
	}
}