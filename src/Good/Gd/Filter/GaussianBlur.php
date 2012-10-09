<?php
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Good 
 * @package
 * @subpackage
 * @filesource GaussianBlur.php
 * @version $Id: $
 * @desc :
 */
class GaussianBlur extends Filter
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_GAUSSIAN_BLUR)) {
			throw \RuntimeException('Unable to apply gaussian blur filter');
		}
	}
}