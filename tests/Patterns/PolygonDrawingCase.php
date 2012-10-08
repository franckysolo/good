<?php
namespace tests\Patterns;

use Good\Core\View;

use Good\Gd\Image;
use Good\Gd\Color\Palette;
use Good\Gd\Pattern\Polygon;
use Good\Gd\Pattern\FilledPolygon;

use Good\UnitTest\UnitCase;

class PolygonDrawingCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle("Dessiner des polygones avec phpmedias");

		//	first create the image document
		$image = new Image(200, 200);

		//	the add the main layer
		$layer1 = $image->newLayer('polygon');
		$resource = $layer1->getResource();
		
				
		// drawing a rectangle pattern
		$pattern = new Polygon($resource);
		$pattern->setCoordinates(10, 10, 50, 10, 50, 30, 50, 50, 30, 50, 30, 30, 10, 30)
				->setColor(Palette::ORANGE)
				->draw();
		
		$pattern = new FilledPolygon($resource);
		$pattern->setCoordinates(110, 110, 150, 110, 150, 130, 150, 150, 130, 150, 130, 130, 110, 130)
				->setColor(Palette::BLUE)
				->draw();
				
		$this->dump($resource);
		
		// add html attributes for view render
		$image->setHtmlAttribute('figcaption', "Dessin de polygones");

		$image->save('polygon');
		View::newInstance()->render($image);

		$this->assert("dessin d'un polygone orange et blue sur le claque principale", $image instanceof Image);
	}
}