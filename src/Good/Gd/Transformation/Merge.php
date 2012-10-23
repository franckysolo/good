<?php
/**
 * Good (Gif oriented object drawing)
 * 
 * @version 1.0
 * @author franckysolo <franckysolo@gmail.com>
 */
namespace Good\Gd\Transformation;
use Good\Gd\Resource;

use Good\Gd\Transformation;
use Good\Gd\LayerList;
use Good\Gd\Layer;
/** 
 * The merge transformation class
 *
 * @author franckysolo <franckysolo@gmail.com>
 * @since 27 sept. 2012
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @category Good 
 * @package Good\Gd
 * @subpackage Transformation 
 */

class Merge extends Transformation
{
	/**
	 * The layerList to merge
	 * 
	 * @access protected
	 * @var LayerList
	 */
	protected $_layerList;
	
	/**
	 * Add a layerList to merge
	 * 
	 * @access public
	 * @param LayerList $list
	 * @return \Good\Gd\Transformation\Merge
	 */
	public function addLayerList(LayerList $list)
	{
		$this->_layerList = $list;
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Good\Gd.Transformation::execute()
	 */	
	public function execute()
	{
 		$source = $this->_layerList->get(0);
 		$this->_layerList->remove(0);
		
		foreach($this->_layerList->getLayers() as $key => $layer) {
			if($layer->hasFilter()) {
				foreach($layer->getFilters() as $filter) {
					$filter->apply($layer->getResource());
				}
			}
			$source = $this->_copyMerge($source, $layer, $layer->getTransparence());
			$this->_layerList->remove($key);
		}
		
		$this->_resource = $source->getResource();
		
		return $source;
	}
	
	/**
	 * Copy & merge layers
	 * 
	 * @param Layer $source
	 * @param Layer $copy
	 * @param integer $transparence
	 * @throws \RuntimeException
	 * @return \Good\Gd\Layer
	 */
	protected function _copyMerge($source, $copy, $transparence)
	{
		$rc = $copy->getResource();
		$rs = $source->getResource();
		
		$x = imagesx($rc);
		$y = imagesy($rc);
		
// 		$color 	= imagecolorat($rc, 0, 0);
//		imagecolortransparent($rc, $color);
		
		if(!imagecopymerge ($rc, $rs, 0, 0, 0, 0, $x, $y, $transparence)) {
			throw new \RuntimeException('Unable to merge layers', 500);
		}
		
		$layer = new Layer($copy->getName(), $copy->getClassResource());
		$layer->setTransparence($transparence);
		
		return $layer;
	}
}