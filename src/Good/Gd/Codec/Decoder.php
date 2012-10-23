<?php
/** 
 *  Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace  Good\Gd\Codec;
use Good\Gd\Codec\Interfaces\Decodable;
/**
 *  The decoder class
 *
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 23 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good
 * @package Good\Gd
 * @subpackage Codec
 */
class Decoder implements Decodable
{
	/**
	 * Decode an image file and create a gd resource
	 *
	 * @access public
	 * @param string $filename
	 * @throws \InvalidArgumentException
	 * @return gd resource
	 * @see Good\Gd\Codec\Interfaces.Decodable::decode()
	 */
	public function decode($filename)
	{
		if(!file_exists($filename)) {
			$message = sprintf('File %s does not exist', $filename);
			throw new \InvalidArgumentException($message, 404);
		}
	
		$data =  file_get_contents($filename);
	
		return imagecreatefromstring($data);
	}
}