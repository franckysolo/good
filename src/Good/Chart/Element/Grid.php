<?php
namespace Good\Chart\Element;
use Good\Gd\Color\Palette;

use Good\Gd\Pattern\DashedLine;
use Good\Gd\Pattern\Line;
use Good\Gd\Pattern\FilledRectangle;
use Good\Chart\Data;
use Good\Chart\Util\Point;
class Grid extends FilledRectangle
{
	protected $_gridx;
	
	protected $_gridy;
	
	protected $_origin;
	
	protected $_scale = array(1, 1);
	
	protected $_interval = array(1, 1);
	
	protected $_isDashed = true;
	
	public function setOrigin(Point $origin)
	{
		$this->_origin = $origin;
		return $this;
	}
	
	public function setScale($xscale, $yscale)
	{
		$this->_scale = array($xscale, $yscale);
		return $this;
	}
	
	public function setInterval($xinc, $yinc)
	{
		$this->_interval = array($xinc, $yinc);
		return $this;
	}
	
	public function draw()
	{
		parent::draw();
		
		list($xmin, $ymin, $xmax, $ymax) = $this->getCoordinates();
		list($xo, $yo) = $this->_origin->getCoordinates();
		list($xscale, $yscale) = $this->_scale;
		list($xinc, $yinc) = $this->_interval;
		//test auto scale manque de souplesse
// 		$xinc = abs($xscale / $xmax - $xmin);
// 		$yinc = abs($yscale / $ymax - $ymin);

		//@todo control for multiple values
		//rescale if scale is small
		if ($yscale < 10) {
			$yinc = 10;
		}
		
		if ($xscale < 10) {
			$xinc = 10;
		}
		
		$line = !$this->_isDashed ? new Line($this->_resource) : new DashedLine($this->_resource);
		$line->setColor(Palette::GRAY);
		if ($this->_isDashed) $line->setForegroundColor(Palette::TRANSPARENT);
		
		if($xo >= $xmin){
			for ($x = $xo; $x > $xmin; $x-= $xscale * $xinc) {
				$line->setCoordinates($x, $ymin, $x, $ymax)->draw();
			}
		}
		
		if($xo < $xmax){
			for ($x = $xo; $x < $xmax; $x+= $xscale * $xinc) {
				$line->setCoordinates($x, $ymin, $x, $ymax)->draw();
			}
		}
		
		if($yo > $ymin) {
			for ($y = $yo; $y > $ymin; $y-= $yscale * $yinc) {
				$line->setCoordinates($xmin, $y, $xmax, $y)->draw();
			}
		}
		
		if($yo < $ymax) {
			for ($y = $yo; $y < $ymax; $y+= $yscale * $yinc) {
				$line->setCoordinates($xmin, $y, $xmax, $y)->draw();
			}
		}
		//var_dump($xo, $yo, $xmin, $xmax, $ymin , $ymax, $xinc, $yinc);
	}
}