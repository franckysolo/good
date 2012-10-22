<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd;
/** 
 * The filter abstract class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage Gd
 */
abstract class Filter
{	
	/**
	 * Returns the name of filter
	 * 
	 * @access public
	 * @return string
	 */
	public function getName()
	{
		$nc = strlen(__CLASS__);
		$className =  get_class($this);
		$cs = strlen($className);
		return ltrim(substr($className, $nc, $cs - $nc), '\\');
	}
	
	/**
	 * Apply a filter to layer
	 *
	 * @access public
	 * @param gd resource $resource
	 * @return void
	 */
	abstract public function apply($resource);
}