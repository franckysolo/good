<?php
namespace tests\Gd\Transformation;

use Good\Gd\Transformation\Thumbnail;
use Good\Gd\Codec;
use Good\Gd\Image;

use Good\UnitTest\UnitCase;

class ThumbnailCase extends  UnitCase
{
	/**
	 * (non-PHPdoc)
	 * @see Good\UnitTest.UnitCase::run()
	 */
	public function run()
	{
		$this->setTitle("Création d'une miniature");

		$image = Image::import('../public/images/image1.jpg');				
		$image->save($image->getLayer()->getName(), Codec::JPEG);
		$image->setHtmlAttribute('figcaption', 'original');
		$image->render();
		
		$thumb = new Thumbnail($image->getLayer()->getResource());
		$this->dump($thumb);
		$thumb->setMaxWidth(100);
		$thumb->setMaxHeigth(50);
		$layer = $thumb->execute();
		$image->setLayer($layer, 0);
		
		$image->save('../tmp/miniature', Codec::JPEG);
		$image->setHtmlAttribute('figcaption', 'miniature');
		$image->render();
		
		$this->assert("Import d'une image jpeg ,sauvegarde d'une copie, création d'une miniature et affichage", $image instanceof Image);
	}
}