<?php
namespace Good\Chart\Element;
use Good\Gd\Pattern\FilledPolygon;

class Arrow extends FilledPolygon
{
	/**
	 * Direction constant arrow
	 * 
	 * @access public
	 * @var integer
	 */
	const LEFT = 0;
	const TOP = 1;
	const RIGHT = 2;
	const BOTTOM = 4;
	
	/**
	 * The size of segment arrow
	 * 
	 * @access protected
	 * @var integer 
	 */
	protected $_size = 10;
	
	/**
 	 * Set the size of segment arrow
	 * 
	 * @access public	 
	 * @param integer $size
	 * @return \Good\Chart\Element\Arrow
	 */
	public function setSize($size)
	{
		$this->_size = (int)$size;
		return $this;
	}
	
	/**
	 * Returns the size of segment arrow
	 * 
	 * @access public
	 * @return integer
	 */
	public function getSize()
	{
		return $this->_size;
	}
	
	/**
	 * Bulid an arrow base on the end of axis & direction 
	 * (positive or negative values to display on graph)
	 * 
	 * @access public
	 * @param integer $x
	 * @param integer $y
	 * @param integer $direction
	 * @return \Good\Chart\Element\Arrow
	 */
	public function build($x, $y, $direction = self::TOP)
	{
		$points = $this->determinePoints($x, $y, $direction);	
		$this->setCoordinates($points);	
		return $this;	
	}
	
	/**
	 * Calculte the arrow points 
	 * 
	 * @access public
	 * @param integer $x
	 * @param integer $y
	 * @param integer $direction
	 * @return array
	 */
	public function determinePoints($x, $y, $direction)
	{
		$points = array();
		$sz = $this->_size / 2;
		
		switch ($direction) {
			case self::LEFT :
				$p1 = array($x, $y + $sz);
				$p2 = array($x - $sz, $y);
				$p3 = array($x, $y - $sz);			
			break;
			
			case self::RIGHT :
				$p1 = array($x - $sz, $y + $sz);
				$p2 = array($x, $y);
				$p3 = array($x - $sz, $y - $sz);
			break;
				
			case self::BOTTOM :
				$p1 = array($x + $sz, $y - $sz);
				$p2 = array($x - $sz, $y - $sz);
				$p3 = array($x, $y);
			break;
			
			default:
				$p1 = array($x - $sz, $y + $sz);
				$p2 = array($x + $sz, $y + $sz);
				$p3 = array($x, $y);
			break;
		}
		
		return  array_merge($p1, $p2, $p3);
	}
}