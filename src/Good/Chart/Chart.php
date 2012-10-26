<?php
namespace Good\Chart;
use Good\Chart\Util\Position;
use Good\Chart\Element\Label;
use Good\Gd\Image;
use Good\Gd\Pattern\Rectangle;
use Good\Gd\Pattern\Fill;
use Good\Gd\Color\Palette;
class Chart extends Image
{
	/**
	 * The title of chart
	 * 
	 * @access protected
	 * @var string  
	 */
	protected $_tilte;
	
	protected $_plot;
	
	/**
	 * Create a new chart
	 * 
	 * @param integer $width
	 * @param integer $height
	 */
	public function __construct($width = 400, $height = 300)
	{
		parent::__construct($width, $height);
		$this->newLayer('background');
	}
	
	public function setBorder($color = Palette::BLACK)
	{
		list($w, $h) = $this->getCanvasSize();
	
		$rectangle = new Rectangle($this->getLayer()->getResource());
		$rectangle->setColor($color)
				  ->setCoordinates(0, 0, $w - 1, $h - 1)
				  ->draw();
	
		return $this;
	}
	
	public function setBackgroundColor($color = Palette::LIGHTGRAY)
	{
		$fill = new Fill($this->getLayer()->getResource());
		$fill->setColor($color)
			 ->setCoordinates(0, 0)
			 ->draw();
	
		return $this;
	}
	
	public function setTitle($title, $size = 10, $angle = 0)
	{
		list($w, $h) = $this->getCanvasSize();
		
		$label = new Label($this->getLayer()->getResource());
		$label->setText($title)
			  ->setAngle($angle)
			  ->setSize($size)
			  ->alignText($w, $h)
			  ->draw();
		
		$this->_title = $title;
		
		return $this;
	}
	
	
	public function plot(Plot $plot)
	{
		$this->_plot = $plot;
		$this->_plot->init();
	}
	
	public function generate()
	{
		$this->_plot->draw();
		$this->save($this->_plot->getName());
	}
}