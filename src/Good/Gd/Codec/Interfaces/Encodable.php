<?php
/**
 *  Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo <franckysolo@gmail.com>
 */


namespace Good\Gd\Codec\Interfaces;
/**
 *  The decodable interface
 *
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 23 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good
 * @package Good\Gd\Codec
 * @subpackage Interfaces
 */
interface Encodable
{
	/**
	 * Encode a gd resource in a file image
	 *
	 * @access public
	 * @param gd resource $resource
	 * @param string $filename
	 * @return void
	 */
	public function encode($resource, $filename);
	
	/**
	 * Get the codec name
	 *
	 * @param boolean $includeDot
	 * @access public
	 * @return string
	 */
	public function getName($includeDot);
	
	/**
	 * Get the codec mime type
	 *
	 * @access public
	 * @return string
	 */
	public function getMimeType();
}