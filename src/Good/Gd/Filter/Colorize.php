<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/**
 * The colorize filter class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package  Good\Gd 
 * @subpackage Filter
 */
class Colorize extends Filter
{
	/**
	 * The color filter
	 * 
	 * @access protected
	 * @var Color
	 */
	protected $_color;

	/**
	 * Set the color filter
	 * 
	 * @access public
	 * @param Color $color
	 * @return \Good\Gd\Filter\Colorize
	 */
	public function setColor(Color $color)
	{		
		$this->_color = $color;
		return $this;
	}

	/**
	 * Get the color filter
	 * 
	 * @access public
	 * @return Color
	 */
	public function getColor()
	{
		if(null == $this->_color) {
			return new Color();
		}
		
		return $this->_color;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		list($r, $g, $b) = $this->getColor()->getRgba();
		if(!imagefilter($resource, IMG_FILTER_COLORIZE, $r, $g, $b)) {
			throw \RuntimeException('Unable to apply brigthness filter');
		}
	}
}