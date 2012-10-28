<?php
namespace Good\Chart\Element;
use Good\Gd\Pattern\Line;

class Axis extends Line
{
	protected $_elements = array();
	protected $_coordinates = array(0 ,0, 0, 0);

	public function addTick($name, $scale, $interval = 1)
	{
		$this->$name = new Tick($this->_resource);	
		$this->$name->init($this, $scale, $interval);	
		return $this;
	}
	
	/**
	 * Set the axis label
	 *
	 * @access public
	 * @param Label $label
	 */
	public function setLabel($text, $size = 10, $angle = 0)
	{
 		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
 		
		$this->label = new Label($this->_resource);
 		$this->label->setText($text)
 					->setSize($size)
 					->setAngle($angle);
 		
 		$x = $x2 - $this->label->getTextWidth();
 		$y = $y2 - $this->label->getTextHeight();
 		
 		$this->label->setCoordinates($x, $y);
 		
		return $this;
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