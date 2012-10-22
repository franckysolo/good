<?php
namespace tests\Gradient;
use Good\Gd\Gradient\Diagonal;

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
		$image = new Image(200, 200);
		$resource = $image->newLayer()->getResource();
		$rectangle = new FilledRectangle($resource);
		$rectangle->setCoordinates(10, 10, 180, 80);
		$gradient = new Diagonal($rectangle);
		$gradient->setColors(array(Palette::RED, Palette::BLUE));
		$rectangle->setGradient($gradient)->draw();
		$image->save('gradient-test');
		View::newInstance()->render($image);
	}
}