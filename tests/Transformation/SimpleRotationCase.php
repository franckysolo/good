<?php
namespace tests\Gd\Transformation;

use Good\Gd\Layer;
use Good\Gd\Pattern;
use Good\Gd\Color\Palette;
use Good\Gd\Pattern\FilledRectangle;
use Good\Gd\Image;
use Good\Gd\Transformation\Rotation;

use Good\UnitTest\UnitCase;

class SimpleRotationCase extends  UnitCase
{
	/**
	 * (non-PHPdoc)
	 * @see Good\UnitTest.UnitCase::run()
	 */
	public function run()
	{
		$this->setTitle("Simple rotation d'un calque");
		
		$image = new Image();		
		$this->assert('Image creation', $image instanceof Image);
		
		$layer = $image->newLayer();
			
		$this->assert("Ajout d'un nouveau calque", $layer instanceof Layer);
		
		$pattern = new FilledRectangle($layer->getResource());
		$pattern->setCoordinates(10, 10, 30, 30)
				->setColor(Palette::ORANGE)
				->draw();
		
		$pattern = new FilledRectangle($layer->getResource());
		$pattern->setCoordinates(30, 30, 60, 60)
				->setColor(Palette::BLUE)
				->draw();
		
		$this->assert("Dessin d'un rectange orange et bleue sur le même calque", $pattern instanceof Pattern);
		
		$image->save('../tmp/rotation-simple-in')
			  ->render();
		
		$rotation = new Rotation($layer->getResource());
		$rotation->setAngle(30);
		$rotation->execute();
		
		$this->assert("Rotation de 45° du calque principal", $pattern instanceof Pattern);
		
 		$image->save('rotation-simple')
 			  ->render();
 		$this->assert("Sauvegarde et affichage", $pattern instanceof Pattern);
	}
}