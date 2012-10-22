<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd;
use Good\Core\Interfaces\Transformable;
/** 
 * The transformation abstract class
 * execute transformation on resource
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 28 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage Gd 
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