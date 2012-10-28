<?php

namespace Good\Chart\Plot;
use Good\Chart\Element\Arrow;

use Good\Gd\Color;

use Good\Gd\Color\Palette;

use Good\Gd\Pattern\DashedLine;

use Good\Gd\Pattern\Line;
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
	
	
	protected $_hasArrow = true;
	
	
	public function draw()
	{
		$datax = $this->_data->getDatax();
		$datay = $this->_data->getDatay();
		
		list($xo, $yo) = $this->_origin->getCoordinates();		
		list($left, $top, $right, $bottom) = $this->getPosition();
		
		//auto scale label axisx
		list(,,$ax, $ay) = $this->axisx->getCoordinates();
		$tw = $this->axisx->label->getTextWidth();
		$th = $this->axisx->label->getTextHeight();
		$this->axisx->label->setCoordinates($ax - $tw / 2, $ay + $th);
		$this->axisx->arrow = new Arrow($this->_resource);
		$this->axisx->arrow->build($ax, $ay, Arrow::RIGHT);
		
		//auto scale label axisy
		list($bx, $by) = $this->axisy->getCoordinates();
		$tw = $this->axisy->label->getTextWidth();
		$th = $this->axisy->label->getTextHeight();
		$this->axisy->label->setCoordinates($bx - $tw / 2, $by + $th);
		$this->axisy->arrow = new Arrow($this->_resource);
		$this->axisy->arrow->build($bx, $by, Arrow::TOP);
				
		// drawing elements axis, labels, ticks
		foreach($this->_elements as $element) {
			//if($element instanceof Drawable) {
				$element->draw();
			//}
		}
		
		$scalex = $this->getXscale();
		$scaley = $this->getYscale();
		$m = $this->_spacing;
		
		foreach ($datay as $key => $value) {
				
			$x1 = (($datax[$key]) * $scalex  + $m->left);
			$x1 += $scalex / 2;
			$y1 = $yo - ($value * $scaley);
			$x2 = $x1;
			$y2 = $yo;
				
			$pattern = $this->_isDashed ? new DashedLine($this->_resource) : new Line($this->_resource);
			
			if($this->_isDashed) {
				$pattern->setForegroundColor(Palette::TRANSPARENT);
				$pattern->setColor($this->_color);
			} else {
				$pattern->setColor($this->_color);
			}
			
			$pattern->setCoordinates($x1, $y1, $x2, $y2)->draw();
			
			if($this->_hasArrow) {
				$arrow = new Arrow($this->_resource);
				$direction = $value > 0 ? Arrow::TOP : Arrow::BOTTOM;
				$arrow->build($x1, $y1, $direction)->setColor($this->_color)->draw();
			}
			
			if(isset($this->_labels[$key])) {
				$label = $this->_labels[$key];
				$label->setSize(8);
				$pos = $label->getBoundingBox();
		
				$x = $x1 + (($x2 - $x1) / 2 - ($pos[2] - $pos[0]) / 2);
				$y = $y1 + ($pos[3] - $pos[1]);
				$y += $this->_hasArrow ? -8 : 0;
				$label->setCoordinates($x, $y)->draw();
			}
		}
		
	}
}