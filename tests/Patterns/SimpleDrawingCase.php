<?php
namespace tests\Patterns;

use Good\Core\View;

use Good\Gd\Gradient\Diagonal;
use Good\Gd\Gradient\Radial;

use Good\Gd\Gradient;

use Good\Gd\Gradient\Linear;

use Good\Gd\Filter\Grayscale;

use Good\Gd\Codec;
use Good\Gd\Image;
use Good\Gd\Color\Palette;

use Good\Gd\Pattern\Pixel;
use Good\Gd\Pattern\Line;
use Good\Gd\Pattern\Rectangle;
use Good\Gd\Pattern\Ellipse;
use Good\Gd\Pattern\Arc;

use Good\Gd\Pattern\FilledArc;
use Good\Gd\Pattern\FilledEllipse;
use Good\Gd\Pattern\FilledRectangle;

use Good\UnitTest\UnitCase;

class SimpleDrawingCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle("Dessiner avec phpmedias");

		//	first create the image document
		$image = new Image(200, 200);

		//	the add the main layer
		$layer1 = $image->newLayer('cube-orange');
		$resource = $layer1->getResource();
		$this->dump($resource);
				
		// drawing a rectangle pattern
		$pattern = new FilledRectangle($resource);
		$pattern->setCoordinates(10, 10, 70, 50)
				->setColor(Palette::ORANGE)
				->draw();
	
		// drawing some random pixel on the same layer
		$pattern = new Pixel($resource);
		for($i = 0; $i < 500; $i++) {		
			$x = mt_rand(1, 199);
			$y = mt_rand(1, 199);
			$r = mt_rand(0, 255);
			$g = mt_rand(0, 255);
			$b = mt_rand(0, 255);
			$pattern->setCoordinates($x, $y)
					->setColor(array($r, $g, $b))
					->draw();
		}
		
		//	drawing axis lines		
		$axis = new Line($resource);
		$axis->setCoordinates(0, 100, 200, 100)
				->draw();
		$axis->setCoordinates(100, 0, 100, 200)
				->draw();
		
		// a rectangle
		$rect = new Rectangle($resource);
		$rect->setCoordinates(0, 60, 80, 80)
			 ->setColor(Palette::RED)
			 ->draw();
		
		// a ellipse
		$ellipse = new Ellipse($resource);
		$ellipse->setCoordinates(100, 100, 80, 60)
			 	->setColor(Palette::RED)
			 	->draw();
		
		// a filled ellipse
		$ellipse = new FilledEllipse($resource);
		$gradient = new Radial($ellipse);
		$gradient->setColors(array(Palette::RED, Palette::GREEN));
		
		$ellipse->setCoordinates(30, 100, 30, 20)
			 	->setColor(Palette::MAROON)
			 	->draw();
			
		// an arc 
		$arc = new Arc($resource);
		$arc->setCoordinates(150, 150, 80, 60, 0, 180)
			->draw();
		
		// a filled arc
		$arc = new FilledArc($resource);
		$arc->setCoordinates(100, 100, 60, 60, 0, 300)
			->setColor(Palette::BLUE)
			->setStyle(FilledArc::EDGED)
			->draw();
		
		// add html attributes for view render
		$image->setHtmlAttribute('figcaption', "Dessin de formes basique");

		$image->save('pattern', Codec::PNG);
		View::newInstance()->render($image);

		$this->assert("Dessin de formes basique sur le claque principale", $image instanceof Image);
	}
}