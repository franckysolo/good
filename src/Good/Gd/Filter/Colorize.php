<?php
namespace Good\Gd\Filter;
use Good\Gd\Filter;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Good 
 * @package
 * @subpackage
 * @filesource Colorize.php
 * @version $Id: $
 * @desc :
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