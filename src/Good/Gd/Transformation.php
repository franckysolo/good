<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\Gd;
use Good\Core\Interfaces\Transformable;
/** 
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Good
 * @subpackage Gd 
 * @filesource Transformation.php
 * @version $Id: $
 * @desc : execute transformation on resource
 */

abstract class Transformation implements Transformable
{
	/**
	 * The resource to transform
	 * 
	 * @access protected
	 * @var gd resource
	 */
	protected $_resource;
	
	/**
	 * Add resource to the transformation
	 * 
	 * @access public
	 * @param gd resource
	 */
	public function __construct($resource)
	{
		if(!is_resource($resource)) {
			$message = 'resource gd is expected for transformation class';
			throw new \InvalidArgumentException($message, 500);
		}
		
		$this->_resource = $resource;	
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Interfaces.Transformable::execute()
	 */
	abstract public function execute();
}