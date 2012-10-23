<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/** 
 * The negate filter class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Filter
 */
class Negate extends Filter
{
	/**
	 * Apply negate filter
	 * 
	 * @param gd resource $resource
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_NEGATE)) {
			throw \RuntimeException('Unable to apply negate filter');
		}
	}
}