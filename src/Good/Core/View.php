<?php
namespace Good\Core;

class View
{
	protected $_view;
	
	protected  function __construct(){}
	
	public static function newInstance()
	{
		return new self();
	}
	
	public function escape($string)
	{
		return htmlspecialchars($string, ENT_NOQUOTES, 'UTF-8');
	}
	
	public function render($class, $namespace = '')
	{
		$name =  get_class($class);
		$filename = ($namespace != '') ? $namespace . $name : $name;
		$filename .= '.phtml';
		$this->_view = $class;
		require $filename;
	}
	
	public function renderChild($class, $namespace = '')
	{
		self::newInstance()->render($class, $namespace);
	}
	
	public function __get($name)
	{
		if(!property_exists($this->_view, $name)){
			$message = sprintf('Undefined property %s on %s', $name, get_class($this->_view));
			throw new \InvalidArgumentException($message, 500);
		}
	}
	
	public function __call($method, $args)
	{
		if(!method_exists($this->_view, $method)){
			$message = sprintf('Undefined method %s on %s', $method, get_class($this->_view));
			throw new \InvalidArgumentException($message, 500);
		}
		
		return call_user_func_array(array($this->_view, $method), $args);
	}
	
	public function __set($name, $value)
	{
		$message = sprintf('View class %s is read only', get_class($this->_view));
		throw new \InvalidArgumentException($message, 500);
	}
}