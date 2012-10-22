<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern;
/** 
 * The line pattern class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern
 */
class Line extends Pattern
{
	/**
	 * The line thickness
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_thickness = 1;
	
	/**
	 * Set the line thickness
	 * 
	 * @access public
	 * @param integer $thickness
	 * @return \Good\Gd\Pattern\Line
	 */
	public function setThickness($thickness) 
	{
		$this->_thickness = (int)$thickness;
		return $this;
	}
	
	/**
	 * Returns the line thickness
	 * 
	 * @access public
	 * @return integer
	 */
	public function getThickness() 
	{
		return $this->_thickness;
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();

		if($this->_thickness > 1) {
			imagesetthickness($this->_resource, $this->_thickness);
		}
		
		if(!imageline($this->_resource, $x1, $y1, $x2, $y2, $this->getColor())) {
			$message = 'Unable to draw line';
			throw new \RuntimeException($message, 500);
		}
	}
}