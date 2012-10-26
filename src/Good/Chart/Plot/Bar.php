<?php
namespace Good\Chart\Plot;
use Good\Gd\Color\Palette;

use Good\Chart\Util\Spacing;
use Good\Gd\Pattern\Rectangle;
use Good\Gd\Pattern\FilledRectangle;
use Good\Chart\Plot;

class Bar extends Plot
{
	/**
	 * The spacing between each bar
	 *
	 * @var Margin
	 */
	protected $_spacing = null;
	
	/**
	 * The gradient hitogram
	 * @var Linear
	 */
	protected $_gradient = null;
	
	/**
	 *
	 * @var boolean
	 */
	protected $_isFilled = false;
	
	public function getSpacing()
	{
		if (null == $this->_spacing) {
			$this->setSpacing(new Spacing(2, 0, 2, 0));
		}
	
		return $this->_spacing;
	}
	
	public function draw()
	{
		// drawing elements axis, labels, ticks
		foreach ($this->_elements as $element) {
			//if($element instanceof Drawable) {
				$element->draw();
			//}
		}
		$datax = $this->_data->getDatax();
		$datay = $this->_data->getDatay();
		$m = $this->getSpacing();
		
		// the origin of space
		list($xo, $yo) = $this->_origin->getCoordinates();
		list($left, $top, $right, $bottom) = $this->getPosition();
		
		$scalex = ($right - $left) / $this->_data->xRange();
		$scaley = ($bottom - $top) / $this->_data->yRange();
		
		$class = ($this->_isFilled)
				? new FilledRectangle($this->_resource)
				: new Rectangle($this->_resource);
		
		$pattern = new $class($this->_resource);
		$pattern->setColor(Palette::BLUE);
		
		foreach ($datay as $key => $value) {
		
			$x1 = (($datax[$key]) * $scalex  + $left);
			$x1 += $m->left;
		
			$y1 = $yo - ($value * $scaley);
			$x2 = $x1 + $scalex -  $m->right - $m->left;
			$y2 = $yo;
		
			$pattern->setCoordinates($x1, $y1, $x2, $y2);
		
// 			if($this->hasGradient()) {
// 				$pattern->setGradient($gradient);
// 			}
				
			$pattern->draw();
// 			if(isset($this->_labelValues[$key])) {
// 				$label = $this->_labelValues[$key];
// 				$label->setSize(10);
// 				$pos = $label->getBoundingBox();
		
// 				$x = $x1 + (($x2 - $x1) / 2 - ($pos[2] - $pos[0]) / 2);
// 				$y = $y1 + ($pos[3] + $pos[1]);
// 				$label->setCoordinates($x, $y)->draw();
// 			}
		}
	}
}