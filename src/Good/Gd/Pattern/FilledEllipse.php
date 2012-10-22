<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern;
use Good\Gd\Gradient\Radial;
use Good\Gd\Pattern;
/** 
 * The filled ellipse pattern class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern 
 */
class FilledEllipse extends Pattern
{
	/**
	 * The gradient instance class
	 * 
	 * @access protected
	 * @var Gradient
	 */
	protected $_gradient = null;
	
	/**
	 * Set the gradient Radial gradient
	 * 
	 * @access public
	 * @param Radial $gradient
	 * @return \Good\Gd\Pattern\FilledEllipse
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