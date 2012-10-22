<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Core;
/**
 *  Good 1.0
 *  
 *  The View class
 *  
 * @author franckysolo <franckysolo@gmail.com>
 * @since 20 oct. 2012
 * @license license.txt
 * @category Good 
 * @package Good
 * @subpackage Core
 * @filesource View.php
 * @version $Id: $
 * @desc : 
 */
class View
{
	/**
	 * The class to display
	 * 
	 * @access protected
	 * @var object
	 */
	protected $_view;
	
	/**
	 * Singleton
	 * @access protected
	 */
	protected  function __construct(){}
	
	/**
	 * Create a new instance of View class
	 * 
	 * @access public
	 * @return View
	 */
	public static function newInstance()
	{
		return new self();
	}
	
	/**
	 * Escape a view parameter
	 * 
	 * @access public
	 * @param string $string
	 * @return string
	 */
	public function escape($string)
	{
		return htmlspecialchars($string, ENT_NOQUOTES, 'UTF-8');
	}
	
	/**
	 * Render a class with phtml file
	 * 
	 * @access public
	 * @param string $class
	 * @param string $namespace
	 * @return void
	 */
	public function render($class, $namespace = '')
	{
		$name =  get_class($class);
		$filename = ($namespace != '') ? $namespace . $name : $name;
		$filename .= '.phtml';
		$this->_view = $class;
		include $filename;
	}
	
	/**
	 * Render a child class
	 * 
	 * @access public
	 * @param string $class
	 * @param string $namespace
	 * @return void
	 */
	public function renderChild($class, $namespace = '')
	{
		self::newInstance()->render($class, $namespace);
	}
	
	/**
	 * Returns unknowed parameter view
	 * 
	 * @param string $name
	 * @throws \InvalidArgumentException
	 * @return mixed
	 */
	public function __get($name)
	{
		if(!property_exists($this->_view, $name)){
			$message = sprintf('Undefined property %s on %s', $name, get_class($this->_view));
			throw new \InvalidArgumentException($message, 500);
		}
		
		return $this->_view->$name;
	}
	
	/**
	 * Call unknowed methods view
	 * 
	 * @param string $method
	 * @param mixed $args
	 * @throws \InvalidArgumentException
	 * @return mixed
	 */
	public function __call($method, $args)
	{
		if(!method_exists($this->_view, $method)){
			$message = sprintf('Undefined method %s on %s', $method, get_class($this->_view));
			throw new \InvalidArgumentException($message, 500);
		}
		
		return call_user_func_array(array($this->_view, $method), $args);
	}
	
	/**
	 * Set unknowed parameter view, but view class is read only
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	public function __set($name, $value)
	{
		$message = sprintf('View class %s is read only', get_class($this->_view));
		throw new \InvalidArgumentException($message, 500);
	}
}