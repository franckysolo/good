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
 * The rounded rectangle class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 30 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern 
 */
class RoundedRectangle extends Rectangle
{
	/**
	 * The radius corner
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_radius = 10;
	
	/**
	 * Set the radius corner
	 * 
	 * @access public
	 * @param integer $radius
	 * @return \Good\Gd\Pattern\RoundedRectangle
	 */
	public function setRadius($radius) 
	{
		$this->_radius = $radius;
		return $this;
	}
	
	/**
	 * Returns the radius corner
	 * 
	 * @access public
	 * @return integer
	 */
	public function getRadius()
	{
		return $this->_radius;
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
		$r =  $this->_radius;
		$d = $r * 2;
		
		$line = new Line($this->_resource);
		$line->setThickness($this->_thickness);
		$line->setColor($this->getColor());
		
		$line->setCoordinates($x1 + $r, $y1, $x2 - $r, $y1)->draw();
		$line->setCoordinates($x1 + $r, $y2, $x2 - $r, $y2)->draw();
		$line->setCoordinates($x1, $y1 + $r, $x1, $y2 - $r)->draw();
		$line->setCoordinates($x2, $y1 + $r, $x2, $y2 - $r)->draw();
		
		$arc = new Arc($this->_resource);
		$arc->setThickness($this->_thickness);
		$arc->setColor($this->getColor());
		
		$arc->setCoordinates($x1 + $r, $y1 + $r, $d, $d, 180, -90)->draw();		
		$arc->setCoordinates($x1 + $r, $y2 - $r, $d, $d, 90, -180)->draw();
		$arc->setCoordinates($x2 - $r, $y1 + $r, $d, $d, -90, 0)->draw();
		$arc->setCoordinates($x2 - $r, $y2 - $r, $d, $d, 0, 90)->draw();		
	}
}