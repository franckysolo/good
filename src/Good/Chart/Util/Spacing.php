<?php
/**
 *  Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Chart\Util;
/**
 *  The spacing class util for charts
 *
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good
 * @package Good\Chart
 * @subpackage Util
 */
class Spacing
{
	/**
	 * The margin params array
	 *
	 * @access public
	 * @var array
	 */
	protected $_params = array();
	
	/**
	 * The margin valid key
	 *
	 * @access public
	 * @var array
	 */
	protected $_keys = array('left', 'top', 'right', 'bottom');
	
	/**
	 * Create a new spacing
	 * 
	 * @param integer $left
	 * @param integer $top
	 * @param integer $right
	 * @param integer $bottom
	 */
	public function __construct($left = 0, $top = 0, $right = 0, $bottom = 0)
	{
		$this->left 	= $left;
		$this->top		= $top;
		$this->right 	= $right;
		$this->bottom 	= $bottom;
	}
	
	/**
	 * Returns a margin param
	 *
	 * @access public
	 * @param string $name
	 * @return integer
	 */
	public function __get($name)
	{
		if($this->isValid($name)) {
			if(isset($this->_params[$name])) {
				return $this->_params[$name];
			}
		}
	
		return 0;
	}
	
	/**
	 * Set a margin param
	 *
	 * @access public
	 * @param string $name
	 * @param integer $value
	 */
	public function __set($name, $value)
	{
		if(isset($this->_params[$name])) {
			return;
		}
	
		if($this->isValid($name)) {
			$this->_params[$name] = (int)$value;
		}
	}
	
	/**
	 * Check if is a valid string key for margin params array
	 *
	 * @access public
	 * @param string $key
	 * @return boolean
	 */
	public function isValid($key)
	{
		if(in_array($key, $this->_keys)){
			return true;
		}
	
		return false;
	}
	
	/**
	 * Returns the array margin
	 *
	 * @access public
	 * @return array
	 */
	public function getParams()
	{
		return array($this->left, $this->top, $this->right, $this->bottom);
	}
	
	/**
	 * Returns vertical margin
	 *
	 * @access public
	 * @return integer
	 */
	public function getVertical()
	{
		return $this->top + $this->bottom;
	}
	
	/**
	 * Returns horizontal margin
	 *
	 * @access public
	 * @return integer
	 */
	public function getHorizontal()
	{
		return $this->left + $this->right;
	}
}