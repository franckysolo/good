<?php
namespace tests\Transformation;

use Good\Gd\Transformation\Merge;

use Good\Gd\Transformation\Crop;
use Good\Gd\Transformation\Thumbnail;
use Good\Gd\Codec;
use Good\Gd\Image;

use Good\UnitTest\UnitCase;

class MergeCase extends  UnitCase
{
	/**
	 * (non-PHPdoc)
	 * @see Good\UnitTest.UnitCase::run()
	 */
	public function run()
	{
		$this->setTitle("Recadrage d'un calque");

		$png = Image::import('../public/images/image2.png');
		
		$png->save($png->getLayer()->getName());
		$png->setHtmlAttribute('figcaption', 'image 1');
		$png->render();
		
		$jpg = Image::import('../public/images/image1.jpg');
		$jpg->save($jpg->getLayer()->getName());
		$jpg->setHtmlAttribute('figcaption', 'image 2');
		$jpg->render();
		
		$layer2 = $png->addLayer('layer-2', $jpg->getLayer());
		$layer2->setTransparence(80);
			
		$png->save('merge', Codec::PNG);
		$png->setHtmlAttribute('figcaption', 'merge images');
		$png->render();
		
		$this->assert("Import de deux images png et jpeg de même taille, sauvegarde d'une copie, fusion des images", $png instanceof Image);
	
		$png = Image::import('../public/images/image2.png');
		$icon = Image::import('../public/images/hide.png');
		$icon->save($icon->getLayer()->getName());
		$icon->setHtmlAttribute('figcaption', 'icon');
		$icon->render();
		
		$layer1 = $png->getLayer();
		$layer2 = $icon->addLayer('layer-2', $layer1);
		$layer2->setTransparence(20);
			
		$icon->save('../tmp/merge-icon', Codec::PNG);
		$icon->setHtmlAttribute('figcaption', 'merge images with different size');
		$icon->render();
		
		$this->assert("Import de deux images png et jpeg de même taille, sauvegarde d'une copie, fusion des images", $png instanceof Image);
		
	}
}