<?php
namespace tests\Patterns;


use Good\Gd\Pattern\DashedRectangle;

use Good\Gd\Pattern\Arc;

use Good\Gd\Pattern\Rectangle;

use Good\Gd\Color\Palette;

use Good\Gd\Image;
use Good\Gd\Color;
use Good\Gd\Pattern\DashedLine;
use Good\Gd\Pattern\Line;

use Good\UnitTest\UnitCase;

class DashedLineDrawingCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle("Les pointillés avec phpmedias");

		//	first create the image document
		$image = new Image(300, 200);

		//	the add the main layer
		$layer1 = $image->newLayer('dashed');
		$resource = $layer1->getResource();
		
				
		// drawing a fancy text pattern
		$line = new DashedRectangle($resource);
		$line->setThickness(1)->setForegroundColor(Palette::TRANSPARENT);
		$line->setCoordinates(0, 0, 100, 100)->draw();
		
		$line->setCoordinates(0, 20, 100, 20)->draw();
		
		$line->setCoordinates(20, 0, 20, 100)->draw();
	
		$this->dump($resource);
		
		// add html attributes for view render
		$image->setHtmlAttribute('figcaption', "Dessin d'une ligne pointillée");

		$image->save('dashedLine');
		$image->render();

		$this->assert("Dessin d'une ligne pointillée", is_resource($resource));
	}
}