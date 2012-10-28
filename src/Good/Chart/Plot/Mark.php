<?php
namespace Good\Chart\Plot;
use Good\Gd\Pattern\DashedLine;

use Good\Core\Interfaces\Drawable;

use Good\Chart\Element\Marker;
use Good\Chart\Util\Spacing;
use Good\Chart\Plot;

use Good\Gd\Gradient\Linear;
use Good\Gd\Gradient\Shape;
use Good\Gd\Color\Palette;
use Good\Gd\Pattern\Rectangle;
use Good\Gd\Pattern\FilledRectangle;
use Good\Gd\Pattern\FilledPolygon;
use Good\Gd\Pattern\Polygon;
use Good\Gd\Pattern\Line;

class Mark extends Bar
{
	protected $_isFilled = false;
	
	protected $_isDashed = true;
	
	public function draw()
	{
		foreach ($this->_elements as $element) {
			
			if (!$element instanceof Drawable) {
				var_dump($element);
				die;
			}
				$element->draw();
		}
		
		$datax = $this->_data->getDatax();
		$datay = $this->_data->getDatay();
	
		list($xo, $yo) = $this->_origin->getCoordinates();	
		list($left, $top, $right, $bottom) = $this->getPosition();
	
		$scalex = ($right - $left) / $this->_data->xRange();
		$scaley = ($bottom - $top) / $this->_data->yRange();
		$m = $this->_spacing;
		
		//Prepare marker class
		$marker = new Marker($this->_resource);
		$marker->setIcon(); // set Icon for test;
		$polys = array();
		
		// we stored joins points
		$joins[] = array($xo, $yo);
		array_push($polys, $xo, $yo);		
		foreach ($datay as $key => $value) {
				
			$x = (($datax[$key]) * $scalex  + $m->left);
			$x += $scalex / 2;
			$y = $yo - ($value * $scaley);
			array_push($polys, $x, $y);	
			$joins[] = array($x, $y);
		}
		
		array_push($polys, $xo + ($right - $left), $yo);
		$joins[] = array($xo + ($right - $left), $yo);
		$polygon = $this->_isFilled ? new FilledPolygon($this->_resource) : new Polygon($this->_resource);
		$polygon->setColor($this->_color);
	
		if ($this->_isFilled) {
			$polygon->setCoordinates($polys)->draw();
		} else {
			
			$line = $this->_isDashed ? new DashedLine($this->_resource) : new Line($this->_resource);
			if($this->_isDashed) $line->setForegroundColor(Palette::TRANSPARENT);
			foreach($joins as $n => $point) {
				if (isset($joins[$n + 1])) {
					$p1 = $joins[$n];
					$p2 = $joins[$n + 1];
					$line->setCoordinates($p1[0], $p1[1], $p2[0], $p2[1])->draw();
				}
			}
		}
		
		foreach ($datay as $key => $value) {
			$x = (($datax[$key]) * $scalex  + $m->left);
			$x += $scalex / 2;
			$y = $yo - ($value * $scaley);
			$marker->setCoordinates($x, $y)->setColor($this->_color)->draw();
			if (isset($this->_labels[$key])) {
				$label = $this->_labels[$key];
				$label->setSize(10);
				$pos = $label->getBoundingBox();
				$xl = $x - ($label->getTextWidth() / 2);
				$yl = $y - 10;
				$label->setCoordinates($xl, $yl)->setColor($this->_color)->draw();
			}
		}
			
		// 		if(null != $this->_gradient && $this->_isFilled) {
		// 			$gradient = new Shape($polygon);
		// 			$gradient->setColors($this->_gradient);
		// 			$polygon->setGradient($gradient);
		// 		}
		
		
	}
}