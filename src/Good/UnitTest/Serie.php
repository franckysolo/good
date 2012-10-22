<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\UnitTest;
use Good\Core\Interfaces\Runnable;
/**
 *  The serie test class 
 *  
 *  This class represent a serie of unit test
 *  
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good
 * @subpackage UnitTest
 */
class Serie implements Runnable
{
	/**
	 * The test cases to run
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_cases = array();
	
	/**
	 * Create a new serie of test cases
	 * 
	 * @access public
	 * @param array $cases
	 */
	public function __construct(array $cases = array()) 
	{
		$this->_cases = (array)$cases;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Core\Interfaces.Runnable::run()
	 */
	public function run()
	{
		$report = new Report();
		
		foreach($this->_cases as $case) 
		{
			$caseResult = $report->newCaseResult($case);
			
			ob_start();
			
			try {
				
				$unitTest = new $case($caseResult);
				//	Init the test
				$unitTest->init();
				
				//	Run it!
				$unitTest->run();
				
				//	Catch php error
				//$caseResult->catchError();
				
			} catch (\Exception $e) {
				//	Catch exception
				$caseResult->setException($e);
			}
			//set the output the result case
			$caseResult->setOutput(ob_get_clean());			
		}
		
		return $report;
	}
}