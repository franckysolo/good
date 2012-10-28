<?php
namespace Good\Chart\Plot;
use Good\Gd\Color;
use Good\Gd\Pattern\Pixel;
use Good\Chart\Plot;

class Math extends Plot
{
	/**
	 * The name of plot image
	 *
	 * @access protected
	 * @var string
	 */
	protected $_name = 'graphic-math';
	
	/**
	 * The math function to plot
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_functions = array();
	
	/**
	 * The array colors for math plot
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_colors = array();

	/**
	 * 
	 * @access protected
	 * @param string $function
	 * @param mixed (int | float) $x
	 */
	public function executeFunction($function, $x)
	{
		preg_match_all("/%s/", $function, $matches);
		$count = count($matches[0]);
		$array = array();
		for ($i = 0; $i < $count; $i++) {
			$array[] = $x;
		}
		$eval = vsprintf($function, $array);
		//var_dump($eval);
		return eval("return $eval;");
	}
	
	
	public function addFunction($function, $color = null)
	{
		$this->_functions[] = $function;
		$this->_colors[] = (null == $color) ? $this->getRandomColor() : $color;
		return $this;
	}
	
	
	public function getRandomColor()
	{
		//@todo replace by palette
		$color = new Color(mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
		return $color;
	}
			
	public function draw()
	{
		foreach ($this->_elements as $element) {	
			$element->draw();
		}
		
		list($xo, $yo) = $this->_origin->getCoordinates();
		
		list($left, $top, $right, $bottom) = $this->getPosition();
		
		$m = $this->_spacing;
		$pattern = new Pixel($this->_resource);
		
		//@FIXME approximatif, fonction affine est fausse!
		foreach ($this->_functions as $key => $function) {
			
			for ($x = $left; $x < $right; $x +=.1) {
				$y = $this->executeFunction($function, $x * .1);			
				$y /= .1;
				$y = ($yo - $y);
				$pattern->setColor($this->_colors[$key]);
				if($y <= $bottom && $y >= $top)
				$pattern->setCoordinates($x, $y)->draw();	
			}
		}
	}
}