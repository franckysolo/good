<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern\Fractal;
use Good\Gd\Resource;
use Good\Gd\Pattern\Fractal;
/**
 *  Good 1.0
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 22 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good
 * @package Good\Gd\Pattern
 * @subpackage Fractal
 * @desc :
 *  the Mandelbrot algorithme :<br />
 * 	<code>
	  	définir iteration_max = $iteration<br />
		Pour chaque point de coordonnées (x; y) du plan :<br />
		    définir c = x + iy	<br />
		    définir z = 0	<br />
		    définir i = 0	<br />
		
		    Faire	<br />
		        z = z*z + c	<br />
		        i = i+1	<br />
		    Tant que module de z < 2 et i < iteration_max	<br />
		
		    si i = iteration_max	<br />
		        dessiner le pixel correspondant au point de coordonné (x; y)	<br />
		    finSi	<br />
		finPour	<br />
	</code>	
 */

class MandelBrot extends Fractal
{
	/**
	 * The zoom
	 * 
	 * @access protected
	 * @var int
	 */
	protected $_zoom = 100;
	
    /**
     * The loop iteration
	 *
	 * @access protected
	 * @var int
	 */	
	protected $_maxIteration = 50;
	
	/**
	 * The limit points
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_coordinates = array(-2.1, -1.2, 0.6, 1.2);
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd\Pattern.Fractal::draw()
	 */
	public function draw()
	{
		set_time_limit(0);
		
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
				
		$zoom = $this->getZoom();
		$width = ($x2 - $x1) * $zoom;
		$height = ($y2 - $y1) * $zoom;
	
		$color = $this->getColor();
		$rs = $this->getResource()->getResource();
		$color->allocate($rs);
				
		$this->_backgroundColor->allocate($rs);
	
		$timer = microtime(true);
		
		for($x = 0; $x < $width; $x++) {
			for($y = 0; $y < $height; $y++) {
				
				$cr = ($x / $zoom) + $x1;
				$ci = ($y / $zoom) + $y1;
				$zr = $zi = $i  = 0;
				
				do{
					$tmp = $zr;
					$zr = pow($zr, 2) - pow($zi, 2) + $cr;
					$zi = (2 * $tmp * $zi) + $ci;
					$i++;
					$max = pow($zr, 2) + pow($zi, 2);
					$b = $i * 255 / $this->_maxIteration;
					$r = $i * 255 / $this->_maxIteration;
				} while($max < 4 and $i < $this->_maxIteration);
	
				if($i == $this->_maxIteration) {
					imagesetpixel($rs, $x, $y, $this->_backgroundColor->getIndex());
				} else {
					$color->setGreen($b);
					$color->setRed($r);
					$color->allocate($rs);
					imagesetpixel($rs, $x, $y, $color->getIndex());
				}
			}
		}
		
		$this->mark($rs, $timer);
	}	
}