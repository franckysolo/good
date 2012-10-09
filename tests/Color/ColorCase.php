<?php
namespace tests\Color;

use Good\Core\View;

use Good\Gd\Color\Palette;

use Good\Gd\Color;
use Good\Gd\Image;
use Good\Gd\Pattern\FilledRectangle;

use Good\UnitTest\UnitCase;


class ColorCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle("Test sur la classe color");

		$image = new Image();
		$layer = $image->newLayer();
		
		$color = new Color(Palette::BLUE);
		
		$rect = new FilledRectangle($layer->getResource());
		$rect->setColor($color);
		$rect->setCoordinates(10, 10, 20, 20);
		$rect->draw();
		
		$color->setRed(255);
		$rect->setColor($color);
		$rect->setCoordinates(30, 30, 40, 40);
		$rect->draw();
		
		$color->setGreen(255);
		$color->setRed(0);
		$rect->setColor($color);
		$rect->setCoordinates(20, 20, 30, 30);
		$rect->draw();
		
		$image->save('../tmp/color');
		View::newInstance()->render($image);
		
		$this->assert('Test sur les couleurs', $color instanceof Color);
	}
}