<?php
namespace tests\Color;

use Good\Gd\Color\Palette;

use Good\Gd\Color;
use Good\Gd\Image;
use Good\Gd\Pattern\FilledRectangle;

use Good\UnitTest\UnitCase;

class PaletteCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle("Test sur la classe Palette");
		
		$palette = new Palette();
		$colors = $palette->randomColor(4);
		
		$this->assert('Génération de palette de couleur aléatoire', is_array($colors));
		
		$palette->blue 		= Palette::BLUE;
		$palette->yellow 	= Palette::YELLOW;
		$palette->red 		= Palette::RED;
		$palette->green 	= Palette::GREEN;
		
		$this->dump($colors, $palette->getColors());
		
		echo $palette->blue . "<br />";
		echo $palette->yellow  . "<br />";
		echo $palette->red  . "<br />";
		
		$this->assert("Génération et stockage d'une palette de couleur spécifique", $palette instanceof Palette);		
	}
}