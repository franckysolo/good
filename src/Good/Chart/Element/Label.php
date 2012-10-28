<?php
namespace Good\Chart\Element;
use Good\Chart\Util\Spacing;
use Good\Chart\Util\Position;
use Good\Gd\Pattern\Text;

class Label extends Text
{
	/**
	 * The vertical text position
	 *
	 * @access protected
	 * @var string
	 */
	protected $_vAlign = Position::CENTER;
	
	/**
	 * The horizontal text position
	 *
	 * @access protected
	 * @var string
	 */
	protected $_hAlign = Position::TOP;
		
	/**
	 * The label text margin
	 *
	 * @access protected
	 * @var Spacing
	 */
	protected $_spacing;
	
	/**
	 * 
	 * @param unknown_type $resource
	 */
	public function __construct($resource)
	{
		parent::__construct($resource);
		$this->_spacing = new Spacing();
	}
	
	public function setHorizontalAlignment($alignement)
	{
		$this->_hAlign = $alignement;
		return $this;
	}	
	
	public function setVerticalAlignment($alignement)
	{
		$this->_vAlign = $alignement;
		return $this;
	}
	
	public function getTextWidth()
	{
		$box = $this->getBoundingBox();
		return ($box[2] - $box[0]);
	}
	
	public function getTextHeight()
	{
		$box = $this->getBoundingBox();
		return ($box[7] - $box[1]);
	}
	
	public function alignText($width, $height)
	{
		$x = $this->valign($width);
		$y = $this->halign($height);
	
		$this->setCoordinates($x, $y);
	
		return $this;
	}
	
	public function valign($width)
	{
		$w = $this->getTextWidth();
		$p = $this->_spacing;
		$sz = $this->getSize();
		
		switch($this->_vAlign)
		{
			case Position::RIGHT : 	$xpos = $width - $w - $p->right - $sz;						break;
			case Position::CENTER :	$xpos = ($width / 2) - (($w + $p->left + $p->right) / 2);	break;
			case Position::LEFT :	$xpos = $sz + $p->left;										break;
	
			default:	$xpos = $sz + $p->left - $p->right + 2;
		}
	
		return $xpos;
	}
	
	public function halign($height)
	{
		$h = $this->getTextHeight();
		$p = $this->_spacing;
		$sz = $this->getSize();
	
		switch($this->_hAlign)
		{
			case Position::BOTTOM :  $ypos = $height - $sz - $h / 2 - $p->bottom;				break;
			case Position::MIDDLE :	 $ypos = ($height / 2) - (($h + $p->top + $p->bottom) / 2);	break;
			case Position::TOP :	 $ypos = $sz - $h / 2 + $p->top;							break;
	
			default:	$ypos = $sz + $p->top - $p->bottom + 2;
		}
	
		return $ypos;
	}
	
	
	public function draw()
	{
		parent::draw();
	}
}