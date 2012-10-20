<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd\Filter;
use Good\Gd\Filter;
 /**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 20 oct. 2012
 * @license license.txt
 * @category Good 
 * @package Gd
 * @subpackage Filter
 * @filesource Contrast.php
 * @version $Id: $
 * @desc : the contrast filter
 */
class Contrast extends Filter
{
	/**
	 * The contrast value
	 * 
	 * @access protected
	 * @var integer
	 */
	protected $_contrast = 0;


	/**
	 * The image contrast 
	 * 
	 * @access public
	 * @param integer $contrast
	 * @return \Good\Gd\Filter\Contrast
	 */
	public function setContrast($contrast)
	{
		if($contrast < -90 or $contrast > 90) {
			$contrast = 0;
		}

		$this->_contrast = (int)$contrast;

		return $this;
	}

	/**
	 * Get the image contrast
	 * 
	 * @access public
	 * @return integer
	 */
	public function getContrast()
	{
		return $this->_contrast;
	}

	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Filter::apply()
	 */
	public function apply($resource)
	{
		if(!imagefilter($resource, IMG_FILTER_CONTRAST, $this->_contrast)) {
			throw \Exception('Unable to apply brigthness filter');
		}
	}
}