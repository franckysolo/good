<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Gd\Gradient\Radial;
use Good\Gd\Pattern;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource FilledPEllipse.php
 * @version $Id: $
 * @desc : the filled ellipse pattern class
 */

class FilledEllipse extends Pattern
{
	/**
	 *
	 * @var Gradient
	 */
	protected $_gradient = null;
	
	/**
	 *
	 * @param Radial $gradient
	 * @return \Good\Gd\Pattern\FilledRectangle
	 */
	public function setGradient(Radial $gradient)
	{
		$this->_gradient = $gradient;
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
		
		if(!imagefilledellipse($this->_resource, $x1, $y1, $x2, $y2, $this->getColor())) {
			$message = 'Unable to draw filled ellipse';
			throw new \RuntimeException($message, 500);
		}
				
		if(null != $this->_gradient) {
			$this->_gradient->apply();
		}
	}
}