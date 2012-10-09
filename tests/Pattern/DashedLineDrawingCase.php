<?php
namespace tests\Gd\Patterns;


use Phpmedias\Graphic\Gd\Pattern\DashedRectangle;

use Phpmedias\Graphic\Gd\Pattern\Arc;

use Phpmedias\Graphic\Gd\Pattern\Rectangle;

use Phpmedias\Graphic\Gd\Color\Palette;

use Phpmedias\Graphic\Gd\Image;
use Phpmedias\Graphic\Gd\Color;
use Phpmedias\Graphic\Gd\Pattern\DashedLine;
use Phpmedias\Graphic\Gd\Pattern\Line;

use Phpmedias\UnitTest\UnitCase;

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
		$line->setThickness(4)->setForegroundColor(Palette::TRANSPARENT);
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