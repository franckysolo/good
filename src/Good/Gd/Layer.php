<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd;
use Good\Gd\Pattern\Fill;
use Good\Core\Interfaces\Drawable;
use Good\Gd\Color\Palette;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage 
 * @filesource Layer.php
 * @version $Id: $
 * @desc : the layer class
 */
class Layer
{
	/**
	 * The layer name 
	 * 
	 * @access protected
	 * @var string
	 */
	protected $_name;
	
	/**
	 * The resource
	 * 
	 * @access protected
	 * @var Resource resource
	 */
	protected $_resource;

	/**
	 * The layer opacity | transparence
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_transparence = 0;
	
	/**
	 * The layer filters
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_filters = array();

	/**
	 * Create a new layer
	 * 
	 * @access public
	 * @param Resource $resource
	 */
	public function __construct($name, Resource $resource, $backgroundColor = Palette::TRANSPARENT)
	{	
		$this->_name 		= $name;	
		$this->_resource 	= $resource;
		$this->setBackgroundColor($backgroundColor);		
	}
	
	/**
	 * clone the layer
	 * 
	 * @access public
	 * @return void
	 */
	public function __clone()
	{
		$this->_resource = clone $this->_resource;
	}
	
	/**
	 * Returns the name of the layer
	 * 
	 * @access public
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}	
	
	/**
	 * Returns the gd resource
	 * 
	 * @access public
	 * @return gd resource
	 */
	public function getResource()
	{
		return $this->_resource->getGd();
	}
	
	/**
	 * Returns the class resource
	 *
	 * @access public
	 * @return \Good\Gd\Resource
	 */
	public function getClassResource()
	{
		return $this->_resource;
	}
		
	/**
	 * Set the background color
	 * 
	 * @param string | Color $color
	 * @return \Good\Gd\Layer
	 */
	public function setBackgroundColor($color)
	{
		$fill  = new Fill($this->getResource());
		
		$color = new Color($color);
		$color->allocate($this->getResource());
		
		//imagecolortransparent($this->getResource(), $color->getIndex());
		
		$fill->setCoordinates(0, 0)
			 ->setColor($color)
			 ->draw();
		
		return $this;
	}	
	
	/**
	 * Set the transparence of the layer
	 * 
	 * @access public
	 * @param integer $visibility
	 * @return \Good\Gd\Layer
	 */
	public function setTransparence($transparence)
	{
		if($transparence < 0) {
			$transparence = 0;
		} else if($transparence > 100) {
			$transparence = 100;
		}
		
		$this->_transparence = (int)$transparence;
		
		return $this;
	}
	
	/**
	 * Return the transparence of the layer
	 * 
	 * @access public
	 * @return integer
	 */
	public function getTransparence()
	{
		return $this->_transparence;
	}
	
	/**
	 * Add a filter to the layer
	 * 
	 * @access public
	 * @param Filter $filter
	 * @return \Good\Gd\Layer
	 */
	public function addFilter(Filter $filter)
	{
		$this->_filters[] = $filter;
		return $this;
	}
	
	/**
	 * Returns the layer filters
	 * 
	 * @access public
	 * @return array
	 */
	public function getFilters() 
	{
		return $this->_filters;
	}
	
	/**
	 * Check if layer has a filter
	 * 
	 * @access public
	 * @return boolean
	 */
	public function hasFilter() 
	{
		return (true === (count($this->_filters) > 0));
	}
}