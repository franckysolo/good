<?php
namespace Good\Chart;

use Good\Gd\Color;

use Good\Gd\Color\Palette;

use Good\Chart\Util\Spacing;
use Good\Chart\Util\Position;
use Good\Chart\Util\Point;
use Good\Chart\Element\Grid;
use Good\Chart\Element\Axis;
use Good\Chart\Element\Marker;
use Good\Core\Interfaces\Drawable;

abstract class Plot implements Drawable
{
	/**
	 * The name of plot, use for saving image
	 *
	 * @access protected
	 * @var string
	 */
	protected $_name;
	
	/**
	 * The gd resource
	 *
	 * @access protected
	 * @var gd resource
	 */
	protected $_resource;
	
	/**
	 * The data to plot
	 * 
	 * @access protected
	 * @var Data
	 */
	protected $_data;
	
	/**
	 * 
	 * @access protected
	 * @var Spacing
	 */
	protected $_spacing;
	
	/**
	 * The origin of graph
	 * 
	 * @access protected
	 * @var Point
	 */
	protected $_origin;	
	
	/**
	 * The scale of axis
	 *
	 * @access protected
	 * @var mixed
	 */
	protected $_scalex, $_scaley;
	
	/**
	 * The color of plot
	 * 
	 * @access protected
	 * @var mixed array | Color
	 */
	protected $_color;
	
	/**
	 * Elements of graph
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_elements = array();
	
	/**
	 * 
	 * @param gd resource $resource
	 * @param string $name
	 */
	public function __construct($resource, $name = 'plot-graph')
	{
		$this->_name = $name;
		$this->_resource = $resource;
	}
	
	public function init()
	{
		$data = $this->_data;
		$this->_spacing = new Spacing(50, 50, 50, 50);
		
		$this->grid = new Grid($this->_resource);
		$this->grid->setCoordinates($this->getPosition())
				    ->setColor(Palette::WHITE);
	
		$this->axisx = new Axis($this->_resource);
		$this->axisy = new Axis($this->_resource);
		
		$posx = $this->setAxisX($data->ymin(), $data->ymax());
		$posy = $this->setAxisY($data->xmin(), $data->xmax());
	
		$this->setOrigin();
	}
	
	public function setColor($color)
	{
		if(is_array($color)) {
			//@todo
		} else {
			$this->_color = $color instanceof Color ? $color : new Color($color);
		}
	}
	
	
	/**
	 * Set the point origin of graph (the axis intercept)
	 *
	 * @param integer $x
	 * @param integer $y
	 * @return \Good\Chart\Plot
	 */
	public function setOrigin($x = null, $y = null)
	{
		if(null == $x or null == $y) {
			//Pa = P1 + ua ( P2 - P1 )
			list($x1, $y1, $x2, $y2) = $this->axisx->getCoordinates();
			//Pb = P3 + ub ( P4 - P3 )
			list($x3, $y3, $x4, $y4) = $this->axisy->getCoordinates();
			$k = (($x4 - $x3) * ($y1 - $y3) - ($y4 - $y3) * ($x1 - $x3))
			/ (($y4 - $y3) * ($x2 - $x1) - ($x4 - $x3) * ($y2 - $y1));
	
			$x = $x1 + $k * ($x2 - $x1);
			$y = $y1 + $k * ($y2 - $y1);
		}
	
		$this->_origin = new Point($x, $y);
			
		$marker = new Marker($this->_resource);
		$marker->setType(Marker::CROSS)
			   ->setCoordinates($x, $y);
		// add to element draw
		$this->marker = $marker;
	
		return $this;
	}
	
	/**
	 * Returns the point origin of graph
	 *
	 */
	public function getOrigin()
	{
		return $this->_origin;
	}
	
	/**
	 * Set the x axis
	 *
	 * @access public
	 * @param mixed (integer | float) $min
	 * @param mixed (integer | float) $max
	 * @return integer
	 */
	public function setAxisX($min, $max)
	{
		list($x1, $y1, $x2, $y2) = $this->getPosition();
		$position = $this->axisXPosition($min, $max);
	
		switch ($position) {
			case Position::TOP:
				$this->axisx->setCoordinates($x1, $y1, $x2, $y1);
				break;
	
			case Position::BOTTOM:
				$this->axisx->setCoordinates($x1, $y2, $x2, $y2);
	
				break;
	
			case Position::ABSOLUTE:
				$y =  ($this->_data->ymin() * $this->getYscale())  + $y2;
				$this->axisx->setCoordinates($x1, $y, $x2, $y);
	
				break;
		}
	
		return $position;
	}
	
	/**
	 * Set the x axis position
	 *
	 * @access public
	 * @param mixed (integer | float) $min
	 * @param mixed (integer | float) $max
	 * @return integer
	 */
	public function axisXPosition($min, $max)
	{
		if($min <= 0 and $max <= 0){
			return Position::TOP;
		} else if($min >= 0 and $max >= 0) {
			return Position::BOTTOM;
		} else {
			return Position::ABSOLUTE;
		}
	}
	
	/**
	 * Set the x axis scale
	 *
	 * @access public
	 * @return \Good\Chart\Plot
	 */
	public function setXscale()
	{
		$maxLength = imagesx($this->_resource) - $this->_margin->getHorizontal();
		$this->_xscale = ($maxLength / $this->_data->xRange());
		return $this;
	}
	
	/**
	 * Returns the x axis scale
	 *
	 * @access public
	 * @return mixed (integer | float)
	 */
	public function getXscale()
	{
		return $this->_xscale;
	}
	
	/**
	 * Set the y axis scale
	 *
	 * @access public
	 * @return \Good\Chart\Plot
	 */
	public function setYscale()
	{
		$maxLength = imagesy($this->_resource) - $this->_margin->getVertical();
		$this->_yscale = ($maxLength / $this->getSerie(0)->yRange());
		return $this;
	}
	
	/**
	 * Returns the y axis scale
	 *
	 * @access public
	 * @return mixed (integer | float)
	 */
	public function getYscale()
	{
		return $this->_yscale;
	}
	
	/**
	 *
	 * @param integer $min
	 * @param integer $max
	 * @return integer
	 */
	public function setAxisY($min, $max)
	{
		list($x1, $y1, $x2, $y2) = $this->getPosition();
		$position = $this->axisYPosition($min, $max);
		switch ($position)
		{
			case Position::LEFT:
				$this->axisy->setCoordinates($x1, $y1, $x1, $y2);
	
				break;
	
			case Position::RIGHT:
				$this->axisy->setCoordinates($x2, $y1, $x2, $y2);
	
				break;
	
			case Position::ABSOLUTE:
				$x = $x2 -  ($this->getSerie(0)->xmax() * $this->_xscale);
				$this->axisy->setCoordinates($x, $y1, $x, $y2);
				break;
		}
	
		return $position;
	}
	
	/**
	 * Set the y axis position
	 *
	 * @access public
	 * @param mixed (integer | float) $min
	 * @param mixed (integer | float) $max
	 * @return integer
	 */
	public function axisYPosition($min, $max)
	{
		if($min <= 0 and $max <= 0){
			return Position::RIGHT;
		} else if($min >= 0 and $max >= 0) {
			return Position::LEFT;
		} else {
			return Position::ABSOLUTE;
		}
	}
	
	/**
	 * The plot position, compute graph spacing
	 * 
	 * @return array
	 */
	public function getPosition()
	{
		$width  = imagesx($this->_resource);
		$height = imagesy($this->_resource);
		$sp = $this->_spacing;
	
		$x1 = $sp->left;
		$y1 = $sp->top;
		$x2 = $width - $sp->right;
		$y2 = $height - $sp->bottom;
	
		return array($x1, $y1, $x2, $y2);
	}
	
	/**
	 * 
	 * @param Data $data
	 * @return \Good\Chart\Plot
	 */
	public function setData(Data $data)
	{
		$this->_data = $data;
		return $this;
	}
		
	/**
	 * Returns the name of the graph
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}
	
	/**
	 * Returns plot elements to draw
	 *
	 * @return array
	 */
	public function getElements()
	{
		return $this->_elements;
	}
	
	/**
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		if(isset($this->_elements[$name])) {
			return $this->_elements[$name];
		}
	
		$message = sprintf('%s element property is not defined', $name);
		throw new \InvalidArgumentException($message, 500);
	}
	
	/**
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function __set($name, $value)
	{
		if(isset($this->_elements[$name])) {
			return;
		}
	
		$this->_elements[$name] = $value;
	}
		
	/**
	 * (non-PHPdoc)
	 * @see Good\Core\Interfaces.Drawable::draw()
	 */
	abstract public function draw();
}