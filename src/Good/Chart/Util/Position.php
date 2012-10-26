<?php
/** 
 *  Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Chart\Util;
/**
 *  The position class util for charts
 *
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good
 * @package Good\Chart
 * @subpackage Util
 */
class Position
{
	const LEFT 		 = 0;
	const TOP 		 = 1;
	const RIGHT 	 = 2;
	const BOTTOM 	 = 4;
	const ABSOLUTE 	 = 8;
	const RELATIVE 	 = 16;
	const CENTER 	 = 24;
	const MIDDLE 	 = 48;
	const VERTICAL 	 = 96;
	const HORIZONTAL = 128;
}