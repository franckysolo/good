<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\UnitTest;
use Good\UnitTest\Report\CaseResult;
use Good\Core\Interfaces\Runnable;
/**
 *  Good 1.0 - The unit test class
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Good
 * @subpackage UnitTest
 * @filesource UnitCase.php
 * @version $Id: $
 * @desc : 
 */
abstract class UnitCase implements Runnable
{
	/**
	 * The case result of unit test
	 * 
	 * @access protected
	 * @var CaseResult $_caseResult
	 */
	protected $_caseResult;
	
	/**
	 * Create a new unit test
	 * 
	 * @access public
	 * @param CaseResult $caseResult
	 */
	public function __construct(CaseResult $caseResult) 
	{
		$this->_caseResult = $caseResult;
	}
	
	/**
	 * Set the string title
	 * 
	 * @param string $title
	 * @return \Good\UnitTest\UnitCase
	 */
	public function setTitle($title)
	{
		$this->_caseResult->setTitle($title);
		return $this;
	}
	
	/**
	 * Add an assertion
	 * 
	 * @param string $label
	 * @param boolean $status
	 * @throws \RuntimeException
	 * @return \Good\UnitTest\UnitCase
	 */
	public function assert($label, $status)
	{
		$dg = debug_backtrace();
		
		if(!extension_loaded('xdebug')) {
			$message = sprintf('xdebug extension is expected when using %s system', __CLASS__);
			throw new \RuntimeException($message, 500);
		}
		
		$this->_caseResult->addAssertion($label, $status, $dg[0]['file'], $dg[0]['line'], xdebug_time_index());
		
		return $this;
	}
	
	/**
	 * Store the var_dump for a specific debug view
	 * 
	 * @access public
	 * @param mixed $arguments
	 * @return \Good\UnitTest\UnitCase
	 */
	public function dump($arguments)
	{
		$arguments = func_get_args();
		$this->_caseResult->addDumpVars($arguments);
		return $this;
	}
		
	/**
	 * Init method to override
	 * @access public
	 * @return void
	 */
	public function init() {}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Core\Interfaces.Runnable::run()
	 */
	abstract public function run();
}