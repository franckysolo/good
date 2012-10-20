<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Filter
 * @filesource Negate.php
 * @version $Id: $
 * @desc : the negate filter
 */
class Negate extends Filter
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_NEGATE)) {
			throw \RuntimeException('Unable to apply negate filter');
		}
	}
}