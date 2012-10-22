<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Core\Interfaces;
/**
 *  Good 1.0 - The runnable interface
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Core
 * @subpackage Interfaces
 * @filesource Runnable.php
 * @version $Id: $
 * @desc : 
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