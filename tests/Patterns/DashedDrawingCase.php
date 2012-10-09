<?php
namespace tests\Gd\Patterns;


use Phpmedias\Graphic\Gd\Color\Palette;

use Phpmedias\Graphic\Gd\Image;
use Phpmedias\Graphic\Gd\Color;
use Phpmedias\Graphic\Gd\Pattern\DashedLine;

use Phpmedias\UnitTest\UnitCase;

class DashedDrawingCase extends  UnitCase
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
		$line = new DashedLine($resource);
		$line->setCoordinates(0, 0, 100, 100);
		$line->setForegroundColor(Palette::TRANSPARENT)->draw();
		
		$line->setCoordinates(0, 20, 100, 20);
		$line->setForegroundColor(Palette::TRANSPARENT)->draw();
		
		$line->setCoordinates(20, 0, 20, 100);
		$line->setForegroundColor(Palette::TRANSPARENT)->draw();
	
		$this->dump($resource);
		
		// add html attributes for view render
		$image->setHtmlAttribute('figcaption', "Dessin d'une ligne pointillée");

		$image->save('dashedLine');
		$image->render();

		$this->assert("Dessin d'une ligne pointillée", is_resource($resource));
	}
}