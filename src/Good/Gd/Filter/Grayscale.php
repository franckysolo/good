<?php
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/** 
 *  Phpmedias 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Phpmedias 
 * @package
 * @subpackage
 * @filesource Grayscale.php
 * @version $Id: $
 * @desc :
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