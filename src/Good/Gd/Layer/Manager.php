<?php
namespace Good\Gd\Layer;
use Good\Gd\LayerList;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 5 oct. 2012
 * @license license.txt
 * @category Good 
 * @package
 * @subpackage
 * @filesource Manager.php
 * @version $Id: $
 * @desc : the layer manager class
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
	 * @access public
	 * @param LayerList $list
	 */
	public function __construct(LayerList $list)
	{
		$this->_layers = $list->getLayers();
	}
	
	/**
	 * @access public
	 * @return array
	 */
	public function getLayers()
	{
		return $this->_layers;
	}
}