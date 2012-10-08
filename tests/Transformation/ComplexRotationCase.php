<?php
namespace tests\Gd\Transformation;

use Good\Gd\Layer;
use Good\Gd\Pattern;
use Good\Gd\Color\Palette;
use Good\Gd\Pattern\FilledRectangle;
use Good\Gd\Image;
use Good\Gd\Transformation\Rotation;

use Good\UnitTest\UnitCase;

class ComplexRotationCase extends  UnitCase
{
	/**
	 * (non-PHPdoc)
	 * @see Good\UnitTest.UnitCase::run()
	 */
	public function run()
	{
		$this->setTitle("Rotation avec plusieurs calques");
		
		$image = new Image();		
		$this->assert('Image creation', $image instanceof Image);
		
		$layer1 = $image->newLayer('layer-1');
		$layer1->setTransparence(75);	
		$layer2 = $image->addLayer('layer-2');
		$layer2->setTransparence(75);
		$layer3 = $image->addLayer('layer-3');
		$layer3->setTransparence(75);
		$layer4 = $image->addLayer('layer-4');
		$layer4->setTransparence(75);
		
		$this->assert("Ajout d'un nouveau calque", $layer1 instanceof Layer);
		
		$pattern = new FilledRectangle($layer1->getResource());
		$pattern->setCoordinates(10, 10, 30, 30)
				->setColor(Palette::ORANGE)
				->draw();
		$this->assert("Dessin d'un rectange orange", $pattern instanceof Pattern);
		
		$pattern = new FilledRectangle($layer2->getResource());
		$pattern->setCoordinates(20, 20, 40, 40)
				->setColor(Palette::RED)
				->draw();
		
		$pattern = new FilledRectangle($layer3->getResource());
		$pattern->setCoordinates(30, 30, 50, 50)
				->setColor(Palette::GREEN)
				->draw();
		
		$pattern = new FilledRectangle($layer4->getResource());
		$pattern->setCoordinates(40, 40, 60, 60)
				->setColor(Palette::ORANGE)
				->draw();
		
		$rotation = new Rotation($layer1->getResource());
		$rotation->setAngle(15);
		$rotation->execute();
		
		$rotation = new Rotation($layer2->getResource());
		$rotation->setAngle(30);
		$rotation->execute();
		
		$rotation = new Rotation($layer3->getResource());
		$rotation->setAngle(45);
		$rotation->execute();
		
		$rotation = new Rotation($layer4->getResource());
		$rotation->setAngle(50);
		$rotation->execute();
		
		$this->assert("Rotation de 45° du rectangle", $pattern instanceof Pattern);
		
 		$image->save('../tmp/rotation-complex')
 			  ->render();
 		$this->assert("Sauvegarde et affichage", $pattern instanceof Pattern);
	}
}