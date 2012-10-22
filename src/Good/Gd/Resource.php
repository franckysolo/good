<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd;
/** 
 * The gd resource class
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 26 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage Gd
 */
class Resource
{
	/**
	 * The gd resource
	 * 
	 * @access protected
	 * @var gd resource
	 */
	protected $_gd;
	
	/**
	 * If canal alpha parameters are saved
	 *
	 * @access protected
	 * @var boolean
	 */
	protected $_saveflag = true;
	
	/**
	 * If canal alphablending is active
	 *
	 * @access protected
	 * @var boolean
	 */
	protected $_alphaBlending = false;
	
	
	/**
	 * Create a new gd resource
	 * 
	 * @access public
	 * @param integer $width
	 * @param integer $height
	 * @param gd resource $gd
	 * @param boolean $saveFlag
	 */
	public function __construct($width = 100, $height = 100, $gd = null, $saveFlag = true)
	{
		if(null != $gd) {
			$width 	= imagesx($gd);
			$height = imagesy($gd);
		} 
		
		if(null == $gd){
			$gd = imagecreatetruecolor($width, $height);
		}
		
		imagealphablending($gd, $this->_alphaBlending);
		imagesavealpha($gd, $saveFlag);
		
		$this->_gd = $gd;	
		$this->_saveFlag = $saveFlag;	
	}
	
	/**
	 * Get the gd resource
	 * 
	 * @access public
	 * @return gd resource
	 */
	public function getGd()
	{
		return $this->_gd;
	}
	
	/**
	 * Clone the resource
	 * 
	 * @access public
	 * @return void
	 */
	public function __clone()
	{
		$w  = imagesx($this->_gd);
		$h  = imagesy($this->_gd);
		$gd = imagecreatetruecolor($w, $h);
		
		imagesavealpha($gd,  $this->_saveflag);
		imagealphablending($gd, $this->_alphaBlending);
		imagecopy($gd, $this->_gd, 0, 0, 0, 0, $w, $h);
		
		$this->_gd = $gd;
	}
	
	/**
	 * Destruct image resource
	 *
	 * @access public
	 * @return void
	 */
	public function __destruct()
	{
		//imagedestroy($this->_gd);
	}	
}