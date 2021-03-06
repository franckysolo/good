<?php
namespace tests\Transformation;

use Good\Core\View;

use Good\Gd\Transformation\Crop;
use Good\Gd\Transformation\Thumbnail;
use Good\Gd\Codec;
use Good\Gd\Image;

use Good\UnitTest\UnitCase;

class CropCase extends  UnitCase
{
	/**
	 * (non-PHPdoc)
	 * @see Good\UnitTest.UnitCase::run()
	 */
	public function run()
	{
		$this->setTitle("Recadrage d'un calque");

		$image = Image::import('../public/images/image.png');				
		$image->save($image->getLayer()->getName());
		$image->setHtmlAttribute('figcaption', 'original');
		View::newInstance()->render($image);
		
		$crop = new Crop($image->getLayer(0)->getResource());
		$crop->setPosition(75, 50);
		$crop->setBox(50, 50);
		$layer = $crop->execute();
		$image->setLayer($layer, 0);
		
		$image->save('../tmp/crop', Codec::PNG);
		$image->setHtmlAttribute('figcaption', 'crop');
		View::newInstance()->render($image);
		
		$this->assert("Import d'une image jpeg ,sauvegarde d'une copie, recadrage de l'image et affichage", $image instanceof Image);
	}
}