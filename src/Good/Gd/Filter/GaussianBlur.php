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
 * The gaussian blur filter
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package  Good\Gd 
 * @subpackage Filter
 */
class GaussianBlur extends Filter
{
	/**
	 * Apply GaussianBlur filter
	 * 
	 * @param gd resource $resource
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_GAUSSIAN_BLUR)) {
			throw \RuntimeException('Unable to apply gaussian blur filter');
		}
	}
}