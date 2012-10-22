<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 * 
 * @author franckysolo
 */
namespace Good;
/**
 * The Autoloader class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage
 */
class Autoloader
{
	/**
	 * Instance of autoloader
	 * 
	 * @access private
	 * @var Autoloader $_instance
	 */
	private static $_instance = null;
	
	/**
	 * Singleton
	 */
	private function __construct(){}
	
	/**
	 * No clone
	 */
	private function __clone(){}
	
	/**
	 * Load a class
	 * 
	 * @access private
	 * @param string $className the string name of the included class
	 * @return void
	 */
	private static function _autoload($className) 
	{
		include $className . '.php';
	}
	
	/**
	 * Set the include path
	 * 
	 * @access private
	 * @return void
	 */
	private static function _setIncludePath() 
	{
		$rootDirectory 	= realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
		$srcDirectory 	= dirname($rootDirectory);
		$testDirectory 	= $srcDirectory . DIRECTORY_SEPARATOR . 'tests';
		$fontDirectory 	= $srcDirectory . DIRECTORY_SEPARATOR . 'public/fonts';
		
		$include_path 	= array($rootDirectory, $testDirectory, $srcDirectory, $fontDirectory);		
		$include_path 	= get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $include_path);		
		set_include_path($include_path);
	}
	
	/**
	 * Start autoload system
	 * 
	 * @access public
	 * @throws \RuntimeException
	 * @return void
	 */
	public static function start()
	{
		if(null !== self::$_instance) {
			throw new \RuntimeException(sprintf('System %s is already started', __CLASS__), 500);
		}
		
		self::$_instance = new self();
		
		if(!spl_autoload_register(array(self::$_instance, '_autoload'))) {
			throw new \RuntimeException($message, 500);
		}
		
		self::_setIncludePath();
	}
	
	/**
	 * Stop autoload system
	 * 
	 * @access public
	 * @throws \RuntimeException
	 * @return void
	 */
	public static function stop()
	{
		if(null !== self::$_instance) {
				
			if(!spl_autoload_unregister(array(self::$_instance, '_autoload'))) {
				throw new \RuntimeException('Could not stop the autoload', 500);
			}
				
			self::$_instance = null;
		}
	}
}