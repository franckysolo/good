<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/** 
 *  Phpmedias 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Phpmedias 
 * @package Gd
 * @subpackage Filter
 * @filesource Grayscale.php
 * @version $Id: $
 * @desc : the grayscale filter
 */
class Grayscale extends Filter
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_GRAYSCALE)) {
			throw \RuntimeException('Unable to apply gaussian blur filter');
		}
	}
}