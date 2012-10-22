<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Pattern;
use Good\Gd\Pattern;
/** 
 * The filled arc pattern class
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern
 */
class FilledArc extends Pattern
{
	/**
	 * Constants arc style
	 * 
	 * @access protected
	 * @var integer
	 */
	const PIE 		= IMG_ARC_PIE;
	const CHORD 	= IMG_ARC_CHORD;
	const NOFILL 	= IMG_ARC_NOFILL;
	const EDGED 	= IMG_ARC_EDGED;
	
	/**
	 * The arc style 
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_style = self::PIE;
	
	/**
	 * Set the style of arc pattern
	 * 
	 * @access public
	 * @param integer $style
	 * @return \Good\Gd\Pattern\FilledArc
	 */
	public function setStyle($style) 
	{
		$this->_style = (int)$style;
		return $this;
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x1, $y1, $x2, $y2, $start, $end) = $this->getCoordinates();
		
		if(!imagefilledarc($this->_resource, $x1, $y1, $x2, $y2, $start, $end, $this->getColor(), $this->_style)) {
			$message = 'Unable to draw filled arc';
			throw new \RuntimeException($message, 500);
		}
	}
}