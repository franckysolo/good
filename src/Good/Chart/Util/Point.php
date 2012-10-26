<?php
namespace Good\Chart\Util;
class Point
{
	/**
	 *
	 * @access public
	 * @var float
	 */
	public $x;
	/**
	 *
	 * @access public
	 * @var float
	 */
	public $y;

	/**
	 *
	 * @access public
	 * @param mixed (float | int) $x
	 * @param mixed (float | int) $y
	 */
	public function __construct($x = 0, $y = 0)
	{
		$this->setCoordinates($x, $y);
	}

	/**
	 *
	 * Enter description here ...
	 * @param mixed (float | int) $x
	 * @param mixed (float | int) $y
	 * @return Point
	 */
	public function setCoordinates($x, $y)
	{
		$this->x = (float)$x;
		$this->y = (float)$y;
		return $this;
	}

	/**
	 * Returns the point coordinates in array format
	 *
	 * @access public
	 * @return array
	 */
	public function getCoordinates()
	{
		return array($this->x, $this->y);
	}

	/**
	 * Check if the point is origin
	 *
	 * @access public
	 * @return boolean
	 */
	public function isOrigin()
	{
		if($this->x == 0 and $this->x == 0) {
			return true;
		}

		return false;
	}

	/**
	 * Get the distance from a another point
	 *
	 * @access public
	 * @param Point $point
	 * @return  mixed (float | int)
	 */
	public function getDistanceFromPoint(Point $point)
	{
		$dx = $point->x - $this->x;
		$dy = $point->y - $this->y;
		return sqrt(pow($dx, 2) + pow($dy, 2));
	}

	/**
	 * Move to another position
	 *
	 * @access public
	 * @param mixed (float | int) $x
	 * @param mixed (float | int) $y
	 * @return Point
	 */
	public function move($x, $y)
	{
		return new Point(
				$this->x + $x,
				$this->y + $y
		);
	}
}