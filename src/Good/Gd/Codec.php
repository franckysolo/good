<?php
namespace Good\Gd;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage 
 * @filesource Codec.php
 * @version $Id: $
 * @desc : The codec abstract class factory
 */
abstract class Codec
{
	/**
	 * PNG codec
	 * 
	 * @access public
	 * @var string
	 */
	const PNG = 'image/png';
	 
	/**
	 * GIF codec
	 * 
	 * @access public
	 * @var string
	 */
    const GIF  = 'image/gif';
    
    /**
     * JPEG codec
     * 
     * @access public
     * @var string
     */
    const JPEG = 'image/jpeg';
    
    /**
     * BMP codec
     * 
     * @access public
     * @var string
     */
    const BMP = 'image/bmp';

    
	/**
     * Create an instance of named codec
     * 
	 * @param string $codec
	 * @param array $options
	 * @throws \InvalidArgumentException
	 * @return Codec
	 */
	public static function factory($name = self::PNG, $options = null)
	{
		$className = __CLASS__ . '\\' . self::findNamespace($name);
		
		if(!class_exists($className, true)) {
			$message = 'Unknow %s className';
			throw new \InvalidArgumentException(sprintf($message, $className), 404);
		}
		
		$class = new $className($options);
		
		return $class;
	}
	
	/**
	 * Find the specific namespace
	 *
	 * @access public
	 * @param string $name
	 * @return string
	 */
	public static function findNamespace($name)
	{
		if(preg_match('/image\//', $name)) {
			//@FIXME bug
			return ucfirst(ltrim($name, 'image/'));
		}
		 
		return  ucfirst($name);
	}
	
	/**
	 * Decode the image and create a gd resource
	 *
	 * @access public
	 * @param string $filename
	 * @throws \InvalidArgumentException
	 * @return gd resource
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
	
	/**
	 * Encode a gd resource in a file image
	 *
	 * @access public
	 * @param gd $resource
	 * @param string $filename
	 * @return void
	 */
	abstract public function encode($resource, $filename);
	
	/**
	 * Get the codec name
	 *
	 * @access public
	 * @return string
	 */
	abstract public function getName();
	
	/**
	 * Get the mime type
	 *
	 * @access public
	 * @return string
	 */
	abstract public function getMimeType();
}