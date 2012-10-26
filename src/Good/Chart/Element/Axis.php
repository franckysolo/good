<?php
namespace Good\Chart\Element;
use Good\Gd\Pattern\Line;

class Axis extends Line
{
	protected $_elements = array();
	protected $_coordinates = array(0 ,0, 0, 0);
	
	/**
	 * The axis label
	 *
	 * @access protected
	 * @var Label
	 */
	protected $_label;
	
	/**
	 * Set the axis label
	 *
	 * @access public
	 * @param Label $label
	 */
	public function setLabel(Label $label)
	{
		$this->_label = $label;
		return $this;
	}
	
	/**
	 * Return the axis label
	 *
	 * @access public
	 * @return
	 */
	public function getLabel()
	{
		return $this->_label;
	}
	
	public function __get($name)
	{
		if(isset($this->_elements[$name])) {
			return $this->_elements[$name];
		}
	
		return null;
	}
	
	public function __set($name, $value)
	{
		if(isset($this->_elements[$name])) {
			return;
		}
	
		$this->_elements[$name] = $value;
	}
	
	public function getElements()
	{
		return $this->_elements;
	}
	
	public function draw()
	{
		foreach($this->_elements as $element) {
			$element->draw();
		}
		
		parent::draw();
	}
}