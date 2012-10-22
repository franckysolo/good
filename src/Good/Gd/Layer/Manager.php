<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Layer;
use Good\Gd\LayerList;
/**
 * The layer manager class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 5 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Gd
 * @subpackage Layer
 */
class Manager 
{
	/**
	 * The layers array
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_layers = array();
	
	/**
	 * Create a new Layer manager
	 * 
	 * @access public
	 * @param LayerList $list
	 */
	public function __construct(LayerList $list)
	{
		$this->_layers = $list->getLayers();
	}
	
	/**
	 * Returns the array layers
	 * 
	 * @access public
	 * @return array
	 */
	public function getLayers()
	{
		return $this->_layers;
	}
}