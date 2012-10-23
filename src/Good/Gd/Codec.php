<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd;
/**
 *  The codec abstract class factory
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage Gd
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
	 * @param string $name
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
			return ucfirst(substr($name, 6));
		}
		 
		return  ucfirst($name);
	}
}