<?php
require '../src/Good/Autoloader.php';
use Good\Autoloader;
use Good\UnitTest\Serie;
use Good\Core\View;

Autoloader::start();

$serie = new Serie(array(
		
	//'tests\Codec\GifCase',
	//'tests\Codec\PngCase',

	//'tests\Color\PaletteCase',
	//'tests\Color\ColorCase',

	//'tests\Fractals\BudhaCase',
	//'tests\Fractals\JuliaCase',
	//'tests\Fractals\MandelCase',
				
	//'tests\Patterns\SimpleDrawingCase',
	//'tests\Patterns\PolygonDrawingCase',
	//'tests\Patterns\TextDrawingCase',
	//'tests\Patterns\RoundedDrawingCase',
	//'tests\Patterns\DashedLineDrawingCase',

 	//'tests\Transformation\SimpleRotationCase',
 	//'tests\Transformation\RotationCase',
 	//'tests\Transformation\ComplexRotationCase',
	//'tests\Transformation\ThumbnailCase',
 	'tests\Transformation\CropCase',
//	'tests\Transformation\MergeCase',
	
));

View::newInstance()->render($serie->run());

Autoloader::stop();