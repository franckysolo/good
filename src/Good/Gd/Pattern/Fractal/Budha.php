<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern\Fractal;
use Good\Gd\Pattern\Fractal;
 /**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 20 oct. 2012
 * @license license.txt
 * @category Good 
 * @package Pattern
 * @subpackage Fractal
 * @filesource Budha.php
 * @version $Id: $
 * @desc : the budha mandelbrot fractal
 */
class Budha extends Fractal
{
	/**
	 * The zoom
	 * 
	 * @access protected
	 * @var int
	 */
	protected $_zoom = 100;
	
	/**
     * The loop treshold
     * 
	 * @access protected
	 * @var int
	 */
	protected $_threshold = 2;
	
	/**
     * The loop iteration
	 *
	 * @access protected
	 * @var int
	 */	
	protected $_maxIteration = 5000;
	
   /**
	* The limit points
	*
	* @access protected
	* @var array
	*/
	protected $_coordinates = array(-2.1, -1.2, 0.6, 1.2);
	
	/**
	 * The irisation parameters for buddha rendering
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_iriseIteration = array(100, 1000, 5000);
	
	/**
	 * If the color are optimised
	 * 
	 * @uses need  a long time execution
	 * @access protected
	 * @var boolean
	 */
	protected $_isOptimised = false;
	
	/**
	 * If the color are optimised
	 * 
	 * @access protected
	 * @param boolean $enable
	 */
	public function setOptimised($enable) {
		if(true == $enable) {
			echo '<script>alert("Optimised fractal need resource, please set the limit php execution time to 0");</script>';				
		}
		$this->_isOptimised = (bool)$enable;
		return $this;
	}

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
		$rs = $this->_resource;
		$timer = microtime(true);			
		$bgColor = $this->getBackgroundColor();	
		if($this->_isOptimised) {
			$this->_maxIteration = max($this->_iriseIteration);
		}						
		$pixels = array();
		$pixRed = array();
		$pixGreen = array();
		$pixBlue = array();
		for ($i = 0; $i < $width; $i++) {
			$pixels[$i] = array();
			$pixRed[$i] = array();
			$pixGreen[$i] = array();
			$pixBlue[$i] = array();
			for ($j = 0; $j < $height; $j++) {
				if($this->_isOptimised) {
					$pixRed[$i][$j] = 0;
					$pixGreen[$i][$j] = 0;
					$pixBlue[$i][$j] = 0;
				} else {
					$pixels[$i][$j] = 0;
				}			
			}	
		}

		for($x = 0; $x < $width; $x++) {			
			for($y = 0; $y < $height; $y++) {
								
				$cr = ($x / $zoom) + $x1;
				$ci = ($y / $zoom) + $y1;
				$zr = $zi = $i  = 0;
					
				$tmpPixels = array();
		
				do {
					$tmp = $zr;
					$zr = $zr * $zr - $zi * $zi + $cr;
					$zi = 2 * $zi * $tmp + $ci;
					$i++;
					$cx = ($zr - $x1) * $zoom;
					$cy = ($zi - $y1) * $zoom;
					$tmpPixels[] = array($cx, $cy);			
					$mod = $zr * $zr + $zi * $zi;
				} while($mod < 4 && $i < $this->_maxIteration);
				
				if($this->_isOptimised) 
				{
					list($itRed, $itGreen, $itBlue) = $this->_iriseIteration;
					if ($i !== $itRed) {
						foreach($tmpPixels as $pixel) {
							if(isset($pixRed[$pixel[0]][$pixel[1]])) {
								$pixRed[$pixel[0]][$pixel[1]]++;
							}
						}
					}
					if ($i !== $itGreen) {
						foreach($tmpPixels as $pixel) {
							if(isset($pixGreen[$pixel[0]][$pixel[1]])) {
								$pixGreen[$pixel[0]][$pixel[1]]++;
							}
						}
					}
					if ($i !== $itBlue) {
						foreach($tmpPixels as $pixel) {
							if(isset($pixBlue[$pixel[0]][$pixel[1]])) {
								$pixBlue[$pixel[0]][$pixel[1]]++;
							}
						}
					}
				} else {
					if ($i !== $this->_maxIteration) {
						foreach($tmpPixels as $pixel) {
							if(isset($pixels[$pixel[0]][$pixel[1]])) {
								$pixels[$pixel[0]][$pixel[1]]++;
							}
						}
					}
				}
			}
		}
		
		for($x = 0; $x < $width; $x++) {			
			for($y = 0; $y < $height; $y++) {
				if($this->_isOptimised) {
					$red = min(array($pixRed[$x][$y], 255));
					$green = min(array($pixGreen[$x][$y], 255));
					$blue = min(array($pixBlue[$x][$y], 255));
				} else {
					$blue = min(array($pixels[$x][$y], 255));
					$red = min(array($pixels[$x][$y], 255));
					$green = min(array($pixels[$x][$y], 255));
				}
				$color = imagecolorallocate($rs, 0, $blue, $green);
				imagesetpixel($rs, $x, $y, $color);
			}
		}	
			
		$this->mark($rs, $timer);
	}
}