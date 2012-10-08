<?php
require '../src/Good/Autoloader.php';
use Good\Autoloader;
use Good\UnitTest\Serie;
use Good\Core\View;

Autoloader::start();

$serie = new Serie(array(
	'tests\Codec\GifCase',
));

View::newInstance()->render($serie->run());