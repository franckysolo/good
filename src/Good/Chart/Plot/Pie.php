<?php
namespace Good\Chart\Plot;
use Good\Gd\Color;

use Good\Gd\Pattern\DashedLine;

use Good\Gd\Pattern\Line;

use Good\Chart\Util\Spacing;

use Good\Gd\Color\Palette;

use Good\Gd\Pattern\Arc;
use Good\Gd\Pattern\FilledArc;

use Good\Chart\Plot;

class Pie extends Plot
{	
	/**
	 *
	 * @access protected
	 * @var string
	 */
	protected $_name = 'graphic-pie';
	
	/**
	 *
	 * @access protected
	 * @var boolean
	 */
	protected $_isFilled = false;
	
	/**
	 *
	 * @access protected
	 * @var mixed (int | float)
	 */
	protected $_radius;
	
	/**
	 * Determinate tick size if == 0 no tick
	 *
	 * @access protected
	 * @var float
	 */
	protected $_offset = 1.8;
	
	/**
	 * The style of join lines
	 *
	 * @access protected
	 * @var string
	 */
	protected $_style = 'dashed';
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Chart.Plot::init()
	 */
	public function init()
	{	
		$this->_spacing = new Spacing(50, 50, 50, 50);
		
		$xo = $w = imagesx($this->_resource) / 2;
		$yo = $h = imagesy($this->_resource) / 2;
	
		$this->setOrigin($xo, $yo);
	
		$this->setRadius(($w > $h) ? $h : $w);
	}
	
	/**
	 * Set the radius of the pie plot
	 * 
	 * @access public
	 * @param mixed (int | float) $radius
	 * @return \Good\Chart\Plot\Pie
	 */
	public function setRadius($radius)
	{
		$this->_radius = $radius;
		return $this;
	}
	
	/**
	 * Returns the radius of the pie plot
	 * 
	 * @access public
	 * @return mixed (int | float)
	 */
	public function getRadius()
	{
		return $this->_radius;
	}
	
	public function draw()
	{
		$m = $this->_spacing;
		$datay = $this->_data->getDatay();
		$sum = $this->_data->ysum();
		$count = $this->_data->count() + 1;
		$angles = 0;
		
		$x1 = $this->getOrigin()->x + $m->left - $m->right;
		$y1 = $this->getOrigin()->y + $m->top - $m->bottom;
		$x2 = $y2 = $this->_radius;
		
		$palette = new Palette();
		$color = $palette->randomColor($count);
		
		foreach ($datay as $key => $value) {
		
			$angle = ($value / $sum * 360);
			$vx = ($this->_radius  / $this->_offset) * cos(deg2rad($angles)) + $x1;
			$vy = ($this->_radius / $this->_offset)  * sin(deg2rad($angles)) + $y1;

			$pattern = !$this->_isFilled ?  new Arc($this->_resource) : new FilledArc($this->_resource);
			
			$pattern->setColor($color[$key]);
				
			if($this->_isFilled) {
				$pattern->setStyle(FilledArc::PIE);
			}
				
			$pattern->setCoordinates($x1, $y1, $x2, $y2, $angles, $angle + $angles)
					->draw();
		
			$line = $this->_style == 'dashed' ? new DashedLine($this->_resource) : new Line($this->_resource);
				
 			if($this->_style == 'dashed') {
				$line->setForegroundColor(Palette::WHITE);
				$line->setBackgroundColor($color[$key]);
			}
				
			$line->setCoordinates($x1, $y1, $vx , $vy)->setColor($color[$key])->draw();
				
// 			if(isset($this->_labelValues[$key])) {
					
// 				$coef = ($this->_labelPosition == Tick::IN) ? 0.5 : 1.1;
// 				$anglex = cos(deg2rad($angles  + $angle / 2)) * $coef;
// 				$angley = sin(deg2rad($angles  + $angle / 2)) * $coef;
		
// 				$tx = ($this->_radius  / $this->_offset)  * $anglex + $x1;
// 				$ty = ($this->_radius  / $this->_offset)  * $angley + $y1;
// 				$ty += 10;
		
// 				$this->_labelValues[$key]->setPoints($tx,  $ty);
// 				$this->_labelValues[$key]->execute();
// 				//Debug
// 				//$driver->line($x1, $y1, $tx , $ty, $red);
// 			}
				
			$angles += $angle;
		}
	}
}