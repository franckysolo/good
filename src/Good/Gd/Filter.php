<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd;
/** 
 *  Good 1.0 - The filter abstract class
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Good
 * @subpackage Gd
 * @filesource Filter.php
 * @version $Id: $
 * @desc : 
 */
abstract class Filter
{
	/**
	 * Apply a filter to layer
	 * 
	 * @access public
	 * @param gd resource $resource
	 */
	abstract public function apply($resource);
	
	/**
	 * 
	 * @return string
	 */
	public function getName()
	{
		$nc = strlen(__CLASS__);
		$className =  get_class($this);
		$cs = strlen($className);
		return ltrim(substr($className, $nc, $cs - $nc), '\\');
	}
}