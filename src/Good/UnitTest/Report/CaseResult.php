<?php
namespace Good\UnitTest\Report;
use Good\Core\Interfaces\Runnable;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package UnitTest
 * @subpackage Report
 * @filesource CaseResult.php
 * @version $Id: $
 * @desc : the case result class
 */
class CaseResult 
{
	/**
	 * The name of the class test
	 * 
	 * @access protected
	 * @var string
	 */
	protected $_name;
	
	/**
	 * The title of the test
	 * 
	 * @access protected
	 * @var string
	 */
	protected $_title;
	
	/**
	 * The status of the test
	 * 
	 * @access protected
	 * @var boolean
	 */
	protected $_status = true;
	
	/**
	 * The assertions of the test
	 *
	 * @access protected
	 * @var array
	 */	
	protected $_assertions = array();
	
	/**
	 * The vars array to display with var_dump
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_dumpVars = array();
	
	/**
	 * The exception catched
	 *
	 * @access protected
	 * @var \Exception
	 */	
	protected $_exception;
	
	/**
	 * The html output of the test
	 *
	 * @access protected
	 * @var string
	 */	
	protected $_output;
	
	/**
	 * Set a new case result
	 * 
	 * @access protected
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->_name = (string)$name;
	}
	
	/**
	 * Return the name of the test
	 * 
	 * @access public
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}
	
	/**
	 * Add an assertion on the test
	 * 
	 * @access public
	 * @param string $label
	 * @param boolean $status
	 * @param string $filename
	 * @param integer $line
	 * @return \Good\UnitTest\Report\CaseResult
	 */
	public function addAssertion($label, $status, $filename, $line)
	{
		$this->_assertions[] = new Assertion($label, $status, $filename, $line, xdebug_time_index());
		$this->_status &= $status;
		return $this;
	}
	
	/**
	 * Add a dump var to the array
	 * 
	 * @access public
	 * @param array $arguments
	 * @return \Good\UnitTest\Report\CaseResult
	 */
	public function addDumpVars(array $arguments = array())
	{
		$this->_dumpVars = $arguments;
		return $this;
	}
	
	/**
	 * Returns the dump vars
	 * 
	 * @access public
	 * @return array
	 */
	public function getDumpVars()
	{
		return $this->_dumpVars;
	}
	
	/**
	 * Get the assertions
	 * 
	 * @access public
	 * @return array
	 */
	public function getAssertions()
	{
		return $this->_assertions;
	}

	/**
	 * Set the test output
	 * 
	 * @access public
	 * @param unknown_type $output
	 * @return \Good\UnitTest\Report\CaseResult
	 */
	public function setOutput($output)
	{
		$this->_output = $output;
		return $this;
	}
	
	/**
	 * Get the test output
	 * 
	 * @access public
	 * @return string
	 */
	public function getOutput()
	{
		return $this->_output;
	}
	
	/**
	 * Set the test status
	 * 
	 * @access public
	 * @return boolean
	 */
	public function getStatus()
	{
		return $this->_status;
	}
	
	/**
	 * Set the test exception
	 * 
	 * @access public
	 * @param \Exception $exception
	 * @return \Good\UnitTest\Report\CaseResult
	 */
	public function setException(\Exception $exception)
	{
		$this->_exception = $exception;
		$this->_status = false;
		return $this;
	}
	
	/**
	 * Set error warning if detected
	 *
	 * @access public
	 * @return \Good\UnitTest\Report\CaseResult
	 */
	public function checkErrors()
	{
		$errors = error_get_last();
		 
		if(!empty($errors))
		{
			$this->_status = false;
			 
			$this->setException(
				new \ErrorException(
					$errors['message'], 0,
					$errors['type'], 
					$errors['file'],
					$errors['line']
				)
			);
		}
		 
		return $this;
	}
	
	/**
	 * Get the test exception
	 * 
	 * @access public
	 * @return \Exception
	 */
	public function getException()
	{
		return $this->_exception;
	}
	
	/**
	 * Set the title test
	 * 
	 * @access public
	 * @param string $title
	 * @return \Good\UnitTest\Report\CaseResult
	 */
	public function setTitle($title)
	{
		$this->_title = (string)$title;
		return $this;
	}
	
	/**
	 * Get the title test
	 * 
	 * @access public
	 * @return string
	 */
	public function getTitle()
	{
		return $this->_title;
	}
}