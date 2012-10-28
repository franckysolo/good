<?php
namespace Good\Chart;

class Data implements \Countable
{
	/**
	 *
	 * Enter description here ...
	 * @var array
	 */
	protected $_datax = array();
	
	/**
	 *
	 * Enter description here ...
	 * @var array
	 */
	protected $_datay = array();
	
	/**
	 * 
	 * @param array $datay
	 * @param array $datax
	 * @throws \OutOfBoundsException
	 */
	public function __construct(array $datay, $datax = null)
	{
	
		foreach ($datay as $key => $data) {
			$this->_datay[] = $data;
		}
	
		$county = count($this->_datay);
	
		if (null === $datax) {
			for ($i = 0; $i < $county; $i++) {
				$this->_datax[] = $i;
			}
		} else {
			$this->_datax = $datax;
		}
	
		$countx = count($this->_datax);

		if ($countx != $county) {
			$message = sprintf('Same count expected for datay & datax, %d versus %d', $county, $countx);
			throw new \OutOfBoundsException($message);
		}
	}
	
	/**
	 *
	 * Enter description here ...
	 * @return mixed
	 */
	public function xmin()
	{
		return min($this->_datax);
	}
	/**
	 *
	 * Enter description here ...
	 * @return mixed
	 */
	public function xmax()
	{
		return max($this->_datax);
	}
	
	/**
	 *
	 * Enter description here ...
	 * @return integer
	 */
	public function xRange()
	{
		$min = ($this->xmin() > 0) ? 0 : ($this->xmin() < 0) ? $this->xmin() : $this->xmin() - 1;
		return $this->xmax() - $min;
	}
	
	/**
	 *
	 * Enter description here ...
	 * @return integer
	 */
	public function yRange()
	{
		$min = ($this->ymin() > 0) ? 0 : $this->ymin();
		return $this->ymax() - $min;
// 		if($this->xmin() < 0) {
// 			return $this->xmax() + $this->xmin() - 1;
// 		}
// 		return $this->xmax() + $this->xmin() + 1;
//		return abs($this->ymin()) + abs($this->ymax()); 
	}
	/**
	 *
	 * Enter description here ...
	 * @return mixed
	 */
	public function ymin()
	{
		return min($this->_datay);
	}
	
	/**
	 *
	 * Enter description here ...
	 * @return mixed
	 */
	public function ymax()
	{
		return max($this->_datay);
	}
	
	/**
	 * Retourne la serie de points de l'axe des x
	 * @return array
	 */
	public function getDatax()
	{
		return $this->_datax;
	}
	/**
	 * Retourne la serie de points de l'axe des y
	 * @return array
	 */
	public function getDatay()
	{
		return $this->_datay;
	}
	
	/**
	 *
	 * Enter description here ...
	 * @return integer
	 */
	public function xsum()
	{
		return array_sum($this->_datax);
	}
	/**
	 *
	 * Enter description here ...
	 * @return integer
	 */
	public function ysum()
	{
		return array_sum($this->_datay);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Countable::count()
	 */
	public function count()
	{
		return count($this->_datay);
	}
}