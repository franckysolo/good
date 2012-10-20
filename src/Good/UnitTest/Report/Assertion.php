<?php
/**
 * Good 1.0 (Gif oriented object drawing)
 *
 * @author franckysolo
 */
namespace Good\UnitTest\Report;
/**
 *  Good 1.0
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 25 sept. 2012
 * @license license.txt
 * @category Good 
 * @package UnitTest
 * @subpackage Report
 * @filesource Assertion.php
 * @version $Id: $
 * @desc : the class assertion for unit test
 */
class Assertion
{
	/**
	 * The label of the assertion
	 * 
	 * @access protected
	 * @var string $label
	 */
	protected $_label;
	
	/**
	 * The filename of the assertion
	 * 
	 * @access protected
	 * @var string $_filename
	 */
	protected $_filename;
	
	/**
	 * The line number of the assertion
	 * 
	 * @access protected
	 * @var integer $_line
	 */
	protected $_line;
	
	/**
	 * The status of the assertion
	 * 
	 * @access protected
	 * @var boolean
	 */
	protected $_status;
	
	/**
	 * The timestamp of the assertion
	 * 
	 * @access protected
	 * @var float
	 */
	protected $_timestamp;
	
	/**
	 * Create a new assertion
	 * 
	 * @access public
	 * @param string $label
	 * @param boolean $status
	 * @param string $filename
	 * @param integer $line
	 * @param integer $timestamp
	 */
	public function __construct($label, $status, $filename, $line, $timestamp)
	{
		$this->setLabel($label);
		$this->setStatus($status);
		$this->setFilename($filename);
		$this->setLine($line);
		$this->setTimestamp($timestamp);
	}
	
	/**
	 * Set the label of the assertion
	 * 
	 * @access public
	 * @param string $label the label of the assertion
	 * @return \Good\UnitTest\Report\Assertion
	 */
	public function setLabel($label)
	{
		$this->_label = (string)$label;
		return $this;
	}
	
	/**
	 * Get the label of the assertion
	 * 
	 * @access public
	 * @return string
	 */
	public function getLabel()
	{
		return $this->_label;
	}
	
	/**
	 * Set the filename of the assertion
	 * 
	 * @access public
	 * @param string $filename
	 * @return \Good\UnitTest\Report\Assertion
	 */
	public function setFilename($filename) 
	{
		$this->_filename = (string)$filename;
		return $this;
	}
	
	/**
	 * Get the filename of the assertion
	 * 
	 * @access public
	 * @return string
	 */
	public function getFilename()
	{
		return $this->_filename;
	}
	
	/**
	 * Set the line number of the assertion
	 * 
	 * @access public
	 * @param integer $line
	 * @return \Good\UnitTest\Report\Assertion
	 */
	public function setLine($line) 
	{
		$this->_line = (int)$line;
		return $this;
	}
	
	/**
	 * Get the line number of the assertion
	 * 
	 * @access public
	 * @return integer
	 */
	public function getLine()
	{
		return $this->_line;
	}
	
	/**
	 * Set the status of the assertion
	 * 
	 * @access public
	 * @param boolean $status
	 * @return \Good\UnitTest\Report\Assertion
	 */
	public function setStatus($status) 
	{
		$this->_status = (bool)$status;
		return $this;
	}
	
	/**
	 * Get the status of the assertion
	 * 
	 * @access public
	 * @return boolean
	 */
	public function getStatus()
	{
		return $this->_status;
	}
	
	/**
	 * Set the timestamp of the assertion
	 * 
	 * @access public
	 * @param float $timestamp
	 * @return \Good\UnitTest\Report\Assertion
	 */
	public function setTimestamp($timestamp) 
	{
		$this->_timestamp = (float)$timestamp;
		return $this;
	}
	
	/**
	 * Get the timestamp of the assertion
	 * 
	 * @access public
	 * @return float
	 */
	public function getTimestamp()
	{
		return $this->_timestamp;
	}	
} 