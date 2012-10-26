<?php

namespace Good\Chart\Plot;
use Good\Gd\Pattern\Rectangle;

use Good\Chart\Plot;


class Stick extends Plot
{
	/**
	 *
	 * @access protected
	 * @var string
	 */
	protected $_name = 'graphic-stick';
	
	/**
	 *
	 * @access protected
	 * @var boolean
	 */
	protected $_isDashed = false;
	
	
	public function draw()
	{
		// drawing elements axis, labels, ticks
		foreach($this->_elements as $element) {
			//if($element instanceof Drawable) {
				$element->draw();
			//}
		}
		
		$datax = $this->_data->getDatax();
		$datay = $this->_data->getDatay();
	
		list($xo, $yo) = $this->_origin->getCoordinates();
	
		list($left, $top, $right, $bottom) = $this->getPosition();
	
		$scalex = ($right - $left) /  $this->_data->xRange();
		$scaley = ($bottom - $top) / $this->_data->yRange();
		$m = $this->_spacing;
	
		foreach ($datay as $key => $value) {
				
			$x1 = (($datax[$key]) * $scalex  + $m->left);
			$x1 += $scalex / 2;
			$y1 = $yo - ($value * $scaley);
			$x2 = $x1;
			$y2 = $yo;
				
			$pattern = new Rectangle($this->_resource);
			//$pattern->setColor($this->_color);
				
// 			if($this->_isDashed) {
// 				$pattern->setStyle(new Dashed($pattern));
// 			}
				
			$pattern->setCoordinates($x1, $y1, $x2, $y2)->draw();
		}
	}
}