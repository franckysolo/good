<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Codec;
use Good\Gd\Codec;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Good\Gd
 * @subpackage Codec
 * @filesource Bmp.php
 * @version $Id: $
 * @desc : the bmp class codec
 */
final class Bmp extends Codec
{
	/**
	 * @{@inheritdoc }
	 * @see Good\Gd.Codec::encode()
	 */
	public function encode($resource, $filename)
	{
		if(!image2wbmp($resource, $filename)){
			throw new \Exception('Unable to encode the gd resource in bmp format');
		}
	}

	/**
	 * (non-PHPdoc)
	 * @{@inheritdoc }
	 * @see Good\Gd.Codec::getName()
	 */
	public function getName($includeDot = false)
	{
		return image_type_to_extension(IMAGETYPE_BMP, $includeDot);
	}

	/**
	 * (non-PHPdoc)
	 * @{@inheritdoc }
	 * @see Good\Gd.Codec::getMimeType()
	 */
	public function getMimeType()
	{
		return image_type_to_mime_type(IMAGETYPE_BMP);
	}
}