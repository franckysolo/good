<?php
namespace Good\Chart\Plot;
use Good\Gd\Gradient\Linear;

use Good\Gd\Color\Palette;

use Good\Chart\Util\Spacing;
use Good\Gd\Pattern\Rectangle;
use Good\Gd\Pattern\FilledRectangle;
use Good\Chart\Plot;

class Bar extends Plot
{
	/**
	 * 
	 * @var integer
	 */
	protected $_offset = 10;
	
	/**
	 * The gradient bar
	 * @var Linear
	 */
	protected $_gradient = null;
	
	/**
	 *
	 * @var boolean
	 */
	protected $_isFilled = true;
	
	public function setGradient(array $colors = array())
	{
		$this->_gradient = $colors;
		$this->setFilled(true);
		return $this;
	}
	
	public function setFilled($isFilled)
	{
		$this->_isFilled = (bool) $isFilled;
		return $this;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public function isFilled()
	{
		return (true === $this->_isFilled);
	}
	
	
	public function draw()
	{
		// drawing elements axis, labels, ticks
		foreach ($this->_elements as $name => $element) {
			//if($name == instanceof Drawable) {
				$element->draw();
			//}
		}
		$datax = $this->_data->getDatax();
		$datay = $this->_data->getDatay();
		$count = $this->_data->count();
			
		// the origin of space
		list($xo, $yo) = $this->_origin->getCoordinates();
		list($left, $top, $right, $bottom) = $this->getPosition();
		
		$scaley = ($bottom - $top) / $this->_data->yRange();
		
		//(o + w) * n <= max & w = n * o
		// o <= max / 3 * n
		$less = $count / 3;
		$offset = ($right - $left) / ($count * $less);
		$w = $less * $offset;
		
		$class = ($this->_isFilled)
				? new FilledRectangle($this->_resource)
				: new Rectangle($this->_resource);
		$pattern = new $class($this->_resource);
		
		foreach ($datay as $key => $value) {
		
			$x1 = (($datax[$key]) * $w) + $xo; // largeur
			$x1 += $offset;
		
			$y1 = $yo - ($value * $scaley);
			$x2 = $x1 + $w - $offset;
			$y2 = $yo - 1;
			
			$pattern->setCoordinates($x1, $y1, $x2, $y2);
			
			//set the gradient color
			if(null != $this->_gradient && $this->_isFilled) {
				$gradient = new Linear($pattern, Linear::HORIZONTAL);
				$gradient->setColors($this->_gradient);
				$pattern->setGradient($gradient);
			}
			
			$pattern->draw();
			if(isset($this->_labels[$key])) {
				$label = $this->_labels[$key];
				$label->setSize(10);
				$pos = $label->getBoundingBox();
		
				$x = $x1 + (($x2 - $x1) / 2 - ($pos[2] - $pos[0]) / 2);
				$y = $y1 + ($pos[3] + $pos[1]);
				$label->setCoordinates($x, $y)->draw();
			}
		}
	}
}