<?php
namespace tests\Chart;

use Good\Chart\Plot\Mark;

use Good\Gd\Color\Palette;

use Good\Chart\Chart;
use Good\Chart\Data;
use Good\Core\View;
use Good\Chart\Plot\Bar;
use Good\Chart\Plot\Pie;
use Good\Chart\Plot\Stick;
use Good\UnitTest\UnitCase;

class MarkCase extends  UnitCase
{
	public function run()
	{
		set_time_limit(0);
		$this->setTitle('Test de graphique en point');
		
		$graph = new Chart();
		$graph->setBackgroundColor()->setBorder();
		$graph->setTitle('Good 1.0 - Mark chart');
		$plot = new Mark($graph, 'mark-chart');
		//$plot->setGradient(array(Palette::BLUE, Palette::WHITE));
		$plot->setColor(array(224, 0, 0));
		$plot->setData(new Data(array(50, 25, 75, 80, 50, 25, 50, 50, 10, 20, 10, 20)))->setLabels();
		$graph->plot($plot);
		$graph->generate();
		View::newInstance()->render($graph);
		
		//$this->dump($plot->getElements());
	}
}