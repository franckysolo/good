<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 30 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Pattern
 * @filesource RoundedFilledRectangle.php
 * @version $Id: $
 * @desc : the rounded filled rectangle class
 */
class RoundedFilledRectangle extends FilledRectangle
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1, $x2, $y2) = $this->getCoordinates();
		$r =  $this->_radius;
		$d = $r * 2;
		
		parent::setCoordinates($x1 + $r, $y1, $x2 - $r, $y2);
		parent::draw();
		
		parent::setCoordinates($x1, $y1 + $r, $x2, $y2  - $r);
		parent::draw();
		
		$arc = new FilledArc($this->_resource);
		$arc->setStyle(FilledArc::PIE);
		$arc->setColor($this->getColor());
		
		$arc->setCoordinates($x1 + $r, $y1 + $r, $d, $d, 180, -90)->draw();		
		$arc->setCoordinates($x1 + $r, $y2 - $r, $d, $d, 90, -180)->draw();
		$arc->setCoordinates($x2 - $r, $y1 + $r, $d, $d, -90, 0)->draw();
		$arc->setCoordinates($x2 - $r, $y2 - $r, $d, $d, 0, 90)->draw();
	}
}