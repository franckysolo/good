<?php
namespace tests\Patterns;

use Good\Core\View;

use Good\Gd\Image;
use Good\Gd\Color\Palette;
use Good\Gd\Pattern\Text;

use Good\UnitTest\UnitCase;

class TextDrawingCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle("Dessiner des textes avec phpmedias");

		//	first create the image document
		$image = new Image(300, 200);

		//	the add the main layer
		$layer1 = $image->newLayer('text');
		$resource = $layer1->getResource();
		
				
		// drawing a fancy text pattern
		$text = new Text($resource);
		$text->setColor(Palette::RED);
		$string = 'Hello world';
		$x = 20;
		$y = 100;
		$angle = 0;
		
		for($i = 0; $i < strlen($string); $i++) {		
			$text->setCoordinates($x, 100)
				 ->setText($string[$i])
				 ->setAngle($angle)
				 ->draw();
			$x += 20;
			$angle += ($angle < 360) ? 90 : -90;
		}
				
		$this->dump($resource);
		
		// add html attributes for view render
		$image->setHtmlAttribute('figcaption', "Dessin d'un texte");

		$image->save('../tmp/text');
		View::newInstance()->render($image);

		$this->assert("dessin d'un text", is_resource($resource));
	}
}