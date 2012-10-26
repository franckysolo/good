<?php
namespace Good\Chart\Element;

use Good\Gd\Pattern\Line;

class Tick extends Line
{
	/**
	 * The tick type in (in the chart)
	 *
	 * @access public
	 * @var string
	 */
	const IN = 'in';

	/**
	 * The tick type out (out of the chart)
	 *
	 * @access public
	 * @var string
	 */
	const OUT = 'out';
}