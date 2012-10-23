<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Transformation;
use Good\Gd\Layer;

use Good\Gd\Resource;
use Good\Gd\Transformation;
/**
 * The rotation class transformation
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Transformation
 */
class Rotation extends Transformation
{			
	/**
	 * The angle rotation
	 *
	 * @access protected
	 * @var integer
	 */
	protected $_angle = 0;
	
	/**
	 * Set the angle rotation
	 *
	 * @access public
	 * @param integer $angle
	 * @return Good\Gd\Transformation\Layer
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
	 * Get the angle rotation
	 *
	 * @access public
	 * @return integer
	 */
	public function getAngle()
	{
		return $this->_angle;
	}
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Transformation::execute()
	 */
	public function execute()
	{	
		$rs 	= $this->_resource;
		$color 	= imagecolorat($rs, 0, 0);
		$rotate = imagerotate($rs, $this->_angle, $color, false);
						
		if(!$rotate) {
			$message = sprintf('Unable to rotate layer % s');
			throw new \RuntimeException($message, 500);
		}
		
		$w  = imagesx($rotate);
		$h  = imagesy($rotate);
		$ws = imagesx($rs);
		$hs = imagesy($rs);
		
		imagecopy($rs, $rotate, 0, 0, 0, 0, $w, $h);
		
		return new Layer(uniqid(), new Resource($w, $h, $rotate));
	}
}