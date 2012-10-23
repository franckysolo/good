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
 * The pattern ttf text class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 20 oct. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Pattern
 */
class Text extends Pattern
{
	/**
	 * The text angle
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_angle = 0;
	
	/**
	 * The font size
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_size = 14;
	
	/**
	 * The font filename
	 * 
	 * @access protected
	 * @var string
	 */
	protected $_fontfile = '../public/fonts/arial.ttf';
	
	/**
	 * The text content
	 * 
	 * @access protected
	 * @var string
	 */
	protected $_text;
	
	/**
	 * Set the font file path
	 * 
	 * @access public
	 * @param string $fontfile
	 * @throws \InvalidArgumentException
	 * @return \Good\Gd\Pattern\Text
	 */
	public function setFontFile($fontfile)
	{
		if(!file_exists($fontfile)) {
			$message = sprintf('Unable to load %s font filename', $fontfile);
			throw new \InvalidArgumentException($message, 404);
		}
		
		$this->_fontfile = $fontfile;
		
		return $this;
	}
	
	/**
	 * Get the font filename
	 *
	 * @access public
	 * @return string
	 */
	public function getFontFile()
	{
		return $this->_fontfile;
	}
	
	/**
	 * Set the font size
	 *
	 * @access public
	 * @param integer $size
	 * @return \Good\Gd\Pattern\Text
	 */
	public function setSize($size) 
	{
		$this->_size = (int)$size;
		return $this;
	}
	
	/**
	 * Get the font size
	 *
	 * @access public
	 * @return integer
	 */
	public function getSize()
	{
		return $this->_size;
	}
	
	/**
	 * Set the text angle
	 *
	 * @access public
	 * @param integer $angle
	 * @return \Good\Gd\Pattern\Text
	 */
	public function setAngle($angle) 
	{
		if($angle < -360 || $angle > 360) {
			$angle = 0;
		}
		
		$this->_angle = (int)$angle;
		
		return $this;
	}
	
	/**
	 * Get the text angle
	 *
	 * @access public
	 * @return integer
	 */
	public function getAngle()
	{
		return $this->_angle;
	}
	
	/**
	 * Set the text content
	 *
	 * @access public
	 * @param string $text
	 */
	public function setText($text) 
	{
		$this->_text = (string)$text;
		return $this;
	}
	
	/**
	 * Get the text content
	 *
	 * @access public
	 * @return string
	 */
	public function getText()
	{
		return $this->_text;
	}
	
	
	/**
	 * Get the text bounding box
	 *
	 * @access public
	 * @return array
	 */
	public function getBoundingBox()
	{
		return imagettfbbox($this->_size, $this->_angle, $this->getFontFile(), $this->_text);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Pattern::draw()
	 */
	public function draw()
	{
		list($x, $y) = $this->getCoordinates();
		
		if(!imagettftext($this->_resource, $this->_size, $this->_angle, $x, $y, $this->getColor(), $this->_fontfile, $this->_text)) {
			$message = 'Unable to draw text';
			throw new \RuntimeException($message, 500);
		}
	}
}