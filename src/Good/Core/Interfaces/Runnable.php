<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Core\Interfaces;
/**
 * The runnable interface
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category  Good
 * @package Good\Core
 * @subpackage Interfaces
 */
interface Runnable 
{
	/**
	 * Run the process
	 * 
	 * @access public
	 * @return void
	 */
	public function run();
}