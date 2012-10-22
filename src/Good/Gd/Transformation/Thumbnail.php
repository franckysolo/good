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
 * The thumbnail class transformation
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 29 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package
 * @subpackage
 */
class Thumbnail extends Transformation
{
	/**
	 * The name oh thumnail
	 *
	 * @access protected
	 * @var string
	 */
	protected $_name;
	
	/**
	 * The max width resize
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_maxWidth = 100;
	
	/**
	 * The max height resize
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_maxHeight = null;
	
	/**
	 * Get the size ratio of new dimension
	 *
	 * @access public
	 * @param integer $width
	 * @param integer $height
	 * @return integer
	 */
	public function getRatio($width, $height)
	{
		$ratio = $height / $width;	
		return $ratio;
	}
	
	/**
	 * Set the max width resize, if max height is set max width will be ignored
	 * 
	 * @access public
	 * @param integer $width
	 * @return \Good\Gd\Transformation
	 */
	public function setMaxWidth($width)
	{
		
		$this->_maxWidth = (int)$width;
		return $this;
	}
	/**
	 * Set the max height resize
	 *
	 * @access public
	 * @param integer $height
	 * @return \Good\Gd\Transformation
	 */
	public function setMaxHeigth($height)
	{
	
		$this->_maxHeight = (int)$height;
		return $this;
	}	

	/**
	 * Returns the max width resize
	 *
	 * @access public
	 * @return integer
	 */
	public function getMaxWidth()
	{
		return $this->_maxWidth;
	}
	
	/**
	 * Returns the max height resize
	 *
	 * @access public
	 * @return integer
	 */
	public function getMaxHeigth()
	{
		return $this->_maxHeight;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Indy\System\Graphic\Gd.Transformation::execute()
	 */
	public function execute()
	{				
		$source = $this->_resource;
		$ws = imagesx($source);
		$hs = imagesy($source);
		$ratio = $this->getRatio($ws, $hs);
		
		if(null != $this->_maxWidth) {
			$nw = $this->_maxWidth;
			if($nw > $ws) {
				throw new \InvalidArgumentException('The new width is higher than orignal width', 500);
			}
			$nh = $ratio * $nw;
		}
		
		if(null != $this->_maxHeight) {			
			$nh = $this->_maxHeight;
			if($nh > $hs) {
				throw new \InvalidArgumentException('The new height is higher than orignal height', 500);
			}
			$nw = $nh / $ratio;
		}
		
		$copy = new Resource($nw, $nh);
		imagecopyresampled($copy->getGd(), $source, 0, 0, 0, 0, $nw, $nh, $ws, $hs);
		
		$layer = new Layer(uniqid(), $copy);
		
		return $layer;	
	}
}