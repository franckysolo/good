<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern\Fractal;
use Good\Gd\Color;
use Good\Gd\Pattern\Fractal;
/**
 *  Good 1.0
 *  
 *  The Julia algorythme
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 20 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd\Pattern
 * @subpackage Fractal
 * @desc :
 * <pre>
 *  définir x1 = -1
	définir x2 = 1
	définir y1 = -1.2
	définir y2 = 1.2
	définir zoom = 100
	définir iteration_max = 150
	
	définir image_x = (x2 - x1) * zoom
	définir image_y = (y2 - y1) * zoom
	
	Pour x = 0 tant que x < image_x par pas de 1 
	    Pour y = 0 tant que y < image_y par pas de 1
	        définir c_r = 0.285
	        définir c_i = 0.01
	        définir z_r = x / zoom + x1
	        définir z_i = y / zoom + y1
	        définir i = 0
	
	        Faire
	            définir tmp = z_r
	            z_r = z_r*z_r - z_i*z_i + c_r
	            z_i = 2*z_i*tmp + c_i
	            i = i+1
	        Tant que z_r*z_r + z_i*z_i < 4 et i < iteration_max
	
	        si i = iteration_max
	            dessiner le pixel de coordonné (x; y)
	        finSi
	    finPour
	finPour
	</pre>
 *
 */
class Julia extends Fractal
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
	 * @access public
	 * @var int
	 */	
	protected $_maxIteration = 150;
	
   /**
	* The limit points
	*
	* @access protected
	* @var array
	*/	
	protected $_coordinates = array(-1, -1.2, 1, 1.2);
	
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
		
		
		$rs = $this->_resource;
		
		$timer = microtime(true);

		$bgColor = $this->getBackgroundColor();
		$color = new Color($this->getColor());
				
		for($x = 0; $x < $width; $x++) {
			for($y = 0; $y < $height; $y++) {

				$zr = ($x / $zoom) + $x1;
				$zi = ($y / $zoom) + $y1;
				$cr = 0.285;
				$ci = 0.01;
				$i  = 0;

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
					imagesetpixel($rs, $x, $y, $bgColor);
				} else {					
					$color->setBlue($b);
					$color->setRed($r);
					$color->allocate($rs);
					imagesetpixel($rs, $x, $y, $color->getIndex());
				}
			}
		}
		$this->mark($rs, $timer);
	}
}