<?php
namespace Good\Gd\Pattern;
use Good\Gd\Gradient\Linear;
use Good\Gd\Color;
use Good\Gd\Gradient;
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
 * @filesource FilledRectangle.php
 * @version $Id: $
 * @desc : the filled rectangle pattern class
 */
 
class FilledRectangle extends Pattern 
{
	/**
	 * 
	 * @var Gradient
	 */
	protected $_gradient = null;
	
	/**
	 * 
	 * @param Linear $gradient
	 * @return \Good\Gd\Pattern\FilledRectangle
	 */
	public function setGradient(Linear $gradient)
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
							
		if(!imagefilledrectangle($this->_resource, $x1, $y1, $x2, $y2, $this->getColor())) {
			$message = 'Unable to draw filledrectangle';
			throw new \RuntimeException($message, 500);
		}
		
		if(null != $this->_gradient) {
			$this->_gradient->apply();
		}
	}
}