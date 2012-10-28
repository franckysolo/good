<?php
namespace tests\Chart;

use Good\Gd\Color\Palette;

use Good\Chart\Chart;
use Good\Chart\Data;
use Good\Core\View;
use Good\Chart\Plot\Math;
use Good\UnitTest\UnitCase;


class MathCase extends UnitCase
{
	public function run()
	{
		$this->setTitle('Test du Package Graphic');
		
		set_time_limit(60);
		$graph = new Chart(400, 400);
		$graph->setBackgroundColor()->setBorder();
		$graph->setTitle('Good 1.0 - Math chart');
		
		$math = new Math($graph);
		$math->setData(new Data(array(5, -5), array(-5, 5)));
		$math->addFunction('10 * cos($x)', Palette::BLUE);
		$math->addFunction('2 * $x / 3 - 20', Palette::FUSHIA);
		$math->addFunction('$x * $x - 5 * $x - 10', Palette::RED);
		$math->addFunction('-tan(%s)', Palette::ORANGE);
  	//	$math->addFunction('4 * sin(4 * cos($x))', Palette::GREEN);
		//Do what you want for your plot graph!!!
		
		//@todo...testing
		//$bar->getGrid()->setInterval(array(100, 100));
		//plot the graph
		$graph->plot($math);
		$graph->generate();
		View::newInstance()->render($graph);
	}
}