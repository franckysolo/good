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
 * @filesource Edge.php
 * @version $Id: $
 * @desc :
 */
class Edge extends Filter
{
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_EDGEDETECT)) {
			throw \RuntimeException('Unable to apply edge detect filter');
		}
	}
}