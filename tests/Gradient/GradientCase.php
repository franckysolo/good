<?php
namespace tests\Gradient;
use Good\Gd\Gradient\Diagonal;
use Good\Gd\Gradient\Linear;

use Good\Gd\Gradient;

use Good\Gd\Gradient\Diamond;
use Good\Core\View;
use Good\Gd\Color\Palette;
use Good\Gd\Color;
use Good\Gd\Image;
use Good\Gd\Pattern\FilledRectangle;

use Good\UnitTest\UnitCase;


class GradientCase extends  UnitCase
{
	public function run()
	{
		set_time_limit(90);
		$this->setTitle("Test sur les dégradés de coleurs");
		$image = new Image(400, 200);
		$resource = $image->newLayer()->getResource();
		$rectangle = new FilledRectangle($resource);
		$rectangle->setCoordinates(10, 10, 20, 180);
		$gradient = new Linear($rectangle);
		$gradient->setColors(array(Palette::RED, Palette::WHITE));
		$rectangle->setGradient($gradient)->draw();
		
		$rectangle->setCoordinates(90, 10, 110, 180);
		$rectangle->setGradient($gradient)->draw();
		
		$image->save('gradient-test');
		View::newInstance()->render($image);
	}
}