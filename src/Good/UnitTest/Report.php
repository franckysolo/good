<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\UnitTest;
use Good\UnitTest\Report\CaseResult;
/**
 *  Good 1.0 - The test report class
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package Good
 * @subpackage UnitTest
 * @filesource Report.php
 * @version $Id: $
 * @desc : 
 */
class Report
{
	/**
	 * The cases results array
	 * 
	 * @access protected
	 * @var array
	 */
	protected $_caseResult = array();
	
	/**
	 * Create a new case result
	 * 
	 * @access public
	 * @param UnitCase $case
	 * @return \Good\UnitTest\Report\CaseResult
	 */
	public function newCaseResult($case)
	{
		return $this->_caseResult[] = new CaseResult($case);
	}
	
	/**
	 * Return the cases results
	 * 
	 * @access public
	 * @return array
	 */
	public function getCaseResult()
	{
		return $this->_caseResult;
	}
	
	/**
	 * Count the number of unit test
	 * 
	 * @access public
	 * @return integer
	 */
	public function getTotalCount()
	{
		return count($this->_caseResult);
	}
	
	/**
	 * Count the number of succeded test
	 * 
	 * @access public
	 * @return integer
	 */
	public function getSuccessCount()
	{
		$count = 0;
		
		foreach ($this->_caseResult as $result) {
			if($result->getStatus()) {
				$count++;
			}
		}
		
		return $count;
	}
}