<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd;
use Good\Gd\Color\Palette;
use Good\Core\Interfaces\Drawable;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Good
 * @subpackage Gd 
 * @filesource Pattern.php
 * @version $Id: $
 * @desc : the pattern class
 */
abstract class Pattern implements Drawable
{
	/**
	 * The gd resource
	 * 
	 * @access protected
	 * @var gd resource 
	 */
	protected $_resource;
	
	/**
	 * The color class
	 * 
	 * @access protected
	 * @var Color
	 */
	protected $_color = null;
	
	/**
	 * The pattern coordinates
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_coordinates = array();
	
	/**
	 * Create a new pattern
	 * 
	 * @access public
	 * @param gd resource
	 */
	public function __construct($resource)
	{
		$this->setResource($resource);
	}
	
	/**
	 * Set the pattern color
	 * 
	 * @access public
	 * @param mixed Color | string | arguments $color
	 * @return \Good\Gd\Pattern
	 */
	public function setColor($color)
	{
		if(!$color instanceof Color) {
			$color = new Color($color);
		}
		
		$color->allocate($this->_resource);
		$this->_color = $color->getIndex();
		
		return $this;
	}
	
	/**
	 * Get the pattern color
	 * 
	 * @access public
	 * @return \Good\Gd\Color
	 */
	public function getColor()
	{
		if(null == $this->_color) {
			$this->setColor(Palette::BLACK);
		}
		
		return $this->_color;
	}
	
	/**
	 * Set the pattern resource
	 * 
	 * @access public
	 * @param gd $resource
	 * @return \Good\Gd\Pattern
	 */
	public function setResource($resource)
	{
		if(!is_resource($resource)) {
			$message = 'Gd resource is expected';
			throw new \InvalidArgumentException($message, 500);
		}
		
		$this->_resource = $resource;
		
		return $this;
	}
	
	/**
	 * Get the pattern resource
	 * 
	 * @access public
	 * @return gd resource
	 */
	public function getResource()
	{
		return $this->_resource;
	}
	
	/**
	 * Set the pattern coordinates
	 * 
	 * @access public
	 * @param array | arguments $arguments
	 * @return \Good\Gd\Pattern
	 */
	public function setCoordinates($arguments)
	{
		if(is_array($arguments)) {
			$this->_coordinates = $arguments;
		} else {
			$this->_coordinates = func_get_args();
		}
				
		return $this;
	}
	
	/**
	 * Get the pattern coordinates
	 * 
	 * @access public
	 * @return array
	 */
	public function getCoordinates()
	{
		return $this->_coordinates;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Interfaces.Drawable::draw()
	 */
	abstract public function draw();
}