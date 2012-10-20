<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern;
/** *
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource Line.php
 * @version $Id: $
 * @desc : the line pattern class
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