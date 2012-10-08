<?php
namespace Good\Gd\Transformation;
use Good\Gd\Layer;

use Good\Gd\Resource;
use Good\Gd\Transformation;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Transformation
 * @filesource Rotation.php
 * @version $Id: $
 * @desc :
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