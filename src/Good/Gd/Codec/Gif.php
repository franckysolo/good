<?php
namespace Good\Gd\Codec;
use Good\Gd\Codec;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good
 * @package Gd
 * @subpackage Codec
 * @filesource Gif.php
 * @version $Id: $
 * @desc :
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