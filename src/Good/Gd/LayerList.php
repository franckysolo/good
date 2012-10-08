<?php
namespace Good\Gd;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Good
 * @subpackage 
 * @filesource LayerList.php
 * @version $Id: $
 * @desc : the list of image layer
 */
class LayerList implements \Countable
{
	/**
	 * The crypt key
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_keys = array();
	
	/**
	 * The layers array
	 *
	 * @access protected
	 * @var array
	 */	
	protected $_layers = array();
	
	/**
	 * Create a new layer list
	 * 
	 * @access public
	 * @param array $layers
	 */
	public function __construct(array $layers = array())
	{
		foreach($layers as $layer) {
			$this->add($layer);
		}
	}
	
	/**
	 * Return the layers array
	 * 
	 * @access public
	 * @return array
	 */
	public function getLayers()
	{
		return $this->_layers;
	}
	
	/**
	 * Add a layer on the list
	 * 
	 * @access public
	 * @param Layer $layer
	 * @return boolean
	 */
	public function add(Layer $layer)
	{
		$key = $this->_cryptKey($layer);
		
		if(isset($this->_keys[$key])){
			return false;
		}
		
		$this->_layers[] = $layer;
		
		return $this->_keys[$key] = true;
	}
	
	/**
	 * Get a layer from the list
	 * 
	 * @access public
	 * @param integer $index
	 * @return Layer | NULL
	 */
	public function get($index)
	{
		if(isset($this->_layers[$index])) {
			return $this->_layers[$index];
		}
		
		return null;
	}
	
	/**
	 * Set a layer on specified index
	 * 
	 * @param integer $index
	 * @param Layer $layer
	 * @return boolean
	 */
	public function set($index, Layer $layer)
	{
		if(isset($this->_layers[$index])) {
			
			$this->_layers[$index] = $layer;
			
			$oldkey = $this->_cryptKey($this->_layers[$index]);
			unset($this->_keys[$oldkey]);
			
			return $this->_keys[$index] = true;
		}
	
		return false;
	}
	
	/**
	 * Remove a layer from the list
	 * 
	 * @access public
	 * @param integer $index
	 * @return Layer | NULL
	 */
	public function remove($index)
	{
		if(isset($this->_layers[$index])) {
			$array = array_splice($this->_layers, $index, 1);
			$key = $this->_cryptKey($array[0]);
			unset($this->_keys[$key]);
			return $array[0];
		}
		
		return null;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Countable::count()
	 */
	public function count()
	{
		return count($this->_layers);
	}
	
	/**
	 * Crypt the array key
	 * 
	 * @access public
	 * @param string $value
	 * @return string
	 */
	protected function _cryptKey($value)
	{
		return md5(serialize($value));
	}
}