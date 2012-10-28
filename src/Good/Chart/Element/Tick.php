<?php
namespace Good\Chart\Element;

use Good\Gd\Pattern\Line;

class Tick extends Line
{
	/**
	 * The tick type in (in the chart)
	 * 
	 * @access public
	 * @var string
	 */   
	const IN = 'in';
	
	/**
	 * The tick type out (out of the chart)
	 * 
	 * @access public
	 * @var string
	 */	
	const OUT = 'out';
	
	/**
	 * The tick type in & out (crossing the axis chart)
	 * 
	 * @access public
	 * @var string
	 */
	const BOTH = 'both';
	
	/**
	 * The first tick wich is just on the origin
	 * 
	 * @access public
	 * @var string
	 */
	const FIRST = 'first';
	
	/**
	 * The first tick wich is at the end of the axis
	 * 
	 * @access public
	 * @var string
	 */
	const LAST = 'last';
	
	/**
	 * The x key tick for tick array
	 * 
	 * @access public
	 * @var string
	 */
	const X = 'tickx';
	
	/**
	 * The y key tick for tick array
	 * 
	 * @access public
	 * @var string
	 */
	const Y = 'ticky';
	
	/**
	 * 
	 * @var unknown_type
	 */
	protected $_origin;
	
	protected $_axis;
	
	/**
	 *
	 * @access protected
	 * @var array
	 */
	protected $_labels = array();
	
	protected $_type = self::OUT;
	
	/**
	 *
	 * @access protected
	 * @var int
	 */
	protected $_size = 5;
	
	protected $_interval = 1;
	/**
	 *
	 * @access protected
	 * @var int
	 */
	protected $_interSize = 3;
	
	public function init(Axis $axis, $scale, $interval = 1)
	{
		if ($scale < 10) {
			$interval = 10;
		}
		$this->_axis = $axis;
		$this->_scale = $scale;
		$this->_interval = $interval;
		return $this;
	}
	
	public function setOrigin($origin)
	{
		$this->_origin = $origin;
		return $this;
	}
	
	public function setLabels(array $labels = array())
	{
		foreach ($labels as $key => $label) {
			$this->setLabel($key, $label);
		}
	}
	
	public function setLabel($key, $label = null)
	{
		$this->_labels[$key] = new Label($this->_resource);
		$text = null === $label ? $key : $label;	
		$this->_labels[$key]->setText($text);
		$this->_labels[$key]->setSize(8);
	
		return $this;
	}
	
	public function draw()
	{
		list($xmin, $ymin, $xmax, $ymax) = $this->_axis->getCoordinates();
		list($xo, $yo) = $this->_origin->getCoordinates();
		
		$line = new Line($this->_resource);
		$size = $this->_type ==  self::IN ? $this->_size : -$this->_size;
		
		if ($xo < $xmax) {
			$key = 0;
			for ($x = $xo + 1; $x < $xmax; $x += $this->_scale * $this->_interval) {
				
				$line->setCoordinates($x, $yo, $x, $yo + $size)->setColor($this->_color)->draw();
				if (!isset($this->_labels[$key])) {
					$this->_labels[$key] = new Label($this->_resource);
					$this->_labels[$key]->setText($this->_interval * $key)->setSize(8);
				}
				$xpos = $this->_labels[$key]->vAlign($this->_scale * $this->_interval);
				$ypos = $this->_labels[$key]->hAlign($size);
				$this->_labels[$key]->setCoordinates($x, $yo + $ypos)->draw();
				$key++;
			}
		}
		
		if ($xo > $xmin) {
			$key = 0;
			for ($x = $xo + 1; $x > $xmin; $x -= $this->_scale * $this->_interval) {
		
				$line->setCoordinates($x, $yo, $x, $yo + $size)->setColor($this->_color)->draw();
				if (!isset($this->_labels[$key])) {
					$this->_labels[$key] = new Label($this->_resource);
					$this->_labels[$key]->setText($this->_interval * $key)->setSize(8);
				}
				$xpos = $this->_labels[$key]->vAlign($this->_scale * $this->_interval);
				$ypos = $this->_labels[$key]->hAlign($size);
				$this->_labels[$key]->setCoordinates($x, $yo + $ypos)->draw();
				$key++;
			}
		}
				
		if ($yo <= $ymax) {
			$key = 0;
			for ($y = $yo; $y > $ymin; $y -= $this->_scale * $this->_interval) {
				$line->setCoordinates($xo, $y, $xo  + $size, $y)->setColor($this->_color)->draw();
				if (!isset($this->_labels[$key])) {
					$this->_labels[$key] = new Label($this->_resource);	
					$this->_labels[$key]->setText($this->_interval * $key)->setSize(8);		
				}
				$ypos = $this->_labels[$key]->hAlign($this->_scale * $this->_interval);
				$w = $this->_labels[$key]->getTextWidth();
				$this->_labels[$key]->setCoordinates($xo - $w * 2, $y + $ypos / 2) ->draw();
				$key++;
			}
		}
		
		if ($yo >= $ymin) {
			$count = 0;
			for ($y = $yo; $y < $ymax; $y += $this->_scale * $this->_interval) {
				$line->setCoordinates($xo, $y, $xo  + $size, $y)->setColor($this->_color)->draw();
				$key++;
				if (!isset($this->_labels[$key])) {
					$this->_labels[$key] = new Label($this->_resource);	
					$txt = -$this->_interval * $count;
					$this->_labels[$key]->setText($txt)->setSize(8);					
				}
				$ypos = $this->_labels[$key]->hAlign($this->_scale * $this->_interval);
				$w = $this->_labels[$key]->getTextWidth();
				//if($y != $yo)
				$this->_labels[$key]->setCoordinates($xo - $w * 2, $y + $ypos / 2)->draw();
				
				$count++;
			}
		}
	}
}