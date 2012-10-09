<?php
namespace tests\Transformation;

use Good\Core\View;

use Good\Gd\Codec;

use Good\Gd\Layer;
use Good\Gd\Pattern;
use Good\Gd\Color\Palette;
use Good\Gd\Pattern\FilledRectangle;
use Good\Gd\Image;
use Good\Gd\Transformation\Rotation;

use Good\UnitTest\UnitCase;

class RotationCase extends  UnitCase
{
	/**
	 * (non-PHPdoc)
	 * @see Good\UnitTest.UnitCase::run()
	 */
	public function run()
	{
		//@todo tester sur plusieurs calques
		$this->setTitle("rotation différente sur deux calques distinct");
		
		$image = new Image(200, 200);		
		$this->assert('Image creation', $image instanceof Image);
		
		$layer = $image->newLayer();
		$layer->setTransparence(75);
		$layer2 = $image->addLayer('layer-2');
		$layer2->setTransparence(75);
		
 		$this->assert("Ajout d'un nouveau calque", $layer instanceof Layer);
		
		$pattern = new FilledRectangle($layer->getResource());
		$pattern->setCoordinates(10, 10, 30, 30)
				->setColor(Palette::RED)
				->draw();
		
		$this->assert("Dessin d'un rectange orange", $pattern instanceof Pattern);
		
		$pattern = new FilledRectangle($layer2->getResource());
		$pattern->setCoordinates(20, 20, 40, 40)
				->setColor(Palette::BLUE)
				->draw();
		//BUG
		$rotation = new Rotation($layer->getResource());
		$rotation->setAngle(30);
		$rotation->execute();
		
		$this->assert("Rotation de 30° du rectangle jaune", $pattern instanceof Pattern);
				
		$rotation = new Rotation($layer2->getResource());
		$rotation->setAngle(45);
		$rotation->execute();
		
		$this->assert("Rotation de 45° du rectangle bleue", $pattern instanceof Pattern);
		
 		$image->save('../tmp/rotation');
 		View::newInstance()->render($image);
 		$this->assert("Sauvegarde et affichage", $pattern instanceof Pattern);
	}
}