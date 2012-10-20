<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Core\Interfaces\Drawable;
use Good\Gd\Color;
use Good\Gd\Pattern;
 /**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 20 oct. 2012
 * @license license.txt
 * @category Good 
 * @package
 * @subpackage
 * @filesource Fractal.php
 * @version $Id: $
 * @desc :
 */
abstract class Fractal extends Pattern
{
	/**
	 * The zoom
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_zoom;

	/**
	 * The loop iteration
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_maxIteration;

	/**
	 * The background color of image
	 *
	 * @access protected
	 * @var Color
	 */
	protected $_backgroundColor;

	/**
	 * set the zoom
	 *
	 * @access public
	 * @param integer $zoom
	 */
	public function setZoom($zoom){
		$this->_zoom = (int)$zoom;
		return $this;
	}

	/**
	 * Get the zoom
	 *
	 * @access public
	 * @return integer
	 */
	public function getZoom(){
		return $this->_zoom;
	}

	/**
	 * Set the loop iteration
	 *
	 * @access public
	 * @param integer $iteration
	 */
	public function setMaxIteration($iteration) {
		$this->_maxIteration = (int)$iteration;
		return $this;
	}

	/**
	 * Get the loop iteration
	 *
	 * @access public
	 * @return integer
	 */
	public function getMaxIteration() {
		return $this->_maxIteration;
	}

	/**
	 * Set the background color
	 *
	 * @access public
	 * @param mixed (Color | string) $color
	 */
	public function setBackgroundColor($color = null) {
		if(null == $color) {
			$color = new Color();
		} else if(!$color instanceof Color) {
			$color = new Color($color);
		}
		
		$color->allocate($this->_resource);

		$this->_backgroundColor = $color->getIndex();

		return $this;
	}

	/**
	 * Get the background color
	 *
	 * @access public
	 */
	public function getBackgroundColor()
	{
		if(null == $this->_backgroundColor) {
			$this->setBackgroundColor();
		}
		return $this->_backgroundColor;
	}

	/**
	 * Mark time execution on image fractal
	 *
	 * @access public
	 * @param gd $resource
	 * @param string $timer
	 * @return void
	 */
	public function mark($resource, $timer)
	{
		$chrono = 'Good Framework 1.0 - Exécution en ';
		$chrono .= round(microtime(true) - $timer, 3);
		$chrono .= 'sec';
		imagestring($resource, 1, 1, 1, utf8_decode($chrono), 0xff0000);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	abstract  public function draw();
}