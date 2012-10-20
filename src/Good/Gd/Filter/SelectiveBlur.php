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
 * @since 29 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Filter
 * @filesource SelectiveBlur.php
 * @version $Id: $
 * @desc : the selective blur filter
 */
class SelectiveBlur extends Filter
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_SELECTIVE_BLUR)) {
			throw \Exception('Unable to apply gaussian blur filter');
		}
	}
}