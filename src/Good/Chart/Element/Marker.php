<?php
namespace Good\Chart\Element;
use Good\Gd\Pattern\Line;

class Marker extends Line
{
	/**
	 *
	 * @access protected
	 * @var integer
	 */
	const CROSS = 0;
	
	/**
	 *
	 * @access protected
	 * @var integer
	 */
	const ADD = 1;
	
	/**
	 *
	 * @access protected
	 * @var string
	 */
	protected $_type = self::CROSS;
	
	/**
	 *
	 * @access public
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->_type = (string)$type;
		return $this;
	}
	
	/**
	 *
	 * @access public
	 * @return string
	 */
	public function getType()
	{
		return $this->_type;
	}
	
	
	public function draw()
	{
		list($x, $y) = $this->getCoordinates();
	
		if($this->_type == self::CROSS) {
			$this->setCoordinates($x + 2, $y + 2, $x - 2, $y - 2);
			parent::draw();
			$this->setCoordinates($x + 2, $y - 2, $x - 2, $y + 2);
			parent::draw();
		} else if($this->_type == self::ADD) {
			//@todo
		} else {
			$this->setCoordinates($x, $y, $x, $y);
			parent::draw();
		}
	}
}