<?php
namespace tests\Patterns;

use Good\Core\View;

use Good\Gd\Pattern\RoundedRectangle;
use Good\Gd\Pattern\RoundedFilledRectangle;

use Good\Gd\Image;
use Good\Gd\Color\Palette;

use Good\UnitTest\UnitCase;

class RoundedDrawingCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle("Dessiner des polygones avec phpmedias");

		//	first create the image document
		$image = new Image(200, 200);

		//	the add the main layer
		$layer1 = $image->newLayer('rounded');
		$resource = $layer1->getResource();
						
		// drawing a rectangle pattern
		$pattern = new RoundedRectangle($resource);
		$pattern->setCoordinates(10, 10, 70, 70)
				->setColor(Palette::ORANGE)
				->draw();
			
		// add html attributes for view render
		$image->setHtmlAttribute('figcaption', "Dessin d'un rounded rectangle");

		$image->save('rounded-rect');
		View::newInstance()->render($image);

		$this->assert("Dessin d'un rounded rectangle", $image instanceof Image);
	}
}