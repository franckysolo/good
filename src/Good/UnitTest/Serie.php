<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\UnitTest;
use Good\Core\Interfaces\Runnable;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package UnitTest
 * @subpackage
 * @filesource Serie.php
 * @version $Id: $
 * @desc : the serie test class, represent a serie of unit test
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