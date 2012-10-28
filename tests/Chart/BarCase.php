<?php
namespace tests\Chart;

use Good\Gd\Color\Palette;

use Good\Chart\Chart;
use Good\Chart\Data;
use Good\Core\View;
use Good\Chart\Plot\Bar;
use Good\Chart\Plot\Pie;
use Good\Chart\Plot\Stick;
use Good\UnitTest\UnitCase;

class BarCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle('Test de graphique en barre');
		
		$graph = new Chart();
		$graph->setBackgroundColor()->setBorder();
		$graph->setTitle('Good 1.0 - Bar chart');
		$plot = new Bar($graph, 'bar-chart');
		$plot->setGradient(array(Palette::BLUE, Palette::WHITE));
		$plot->setData(new Data(array(50, 25, 0, 10, 50, 50, 80, /*50, 50, 80, 50, 50*/)))->setLabels();
		$graph->plot($plot);
		$graph->generate();
		View::newInstance()->render($graph);
		
		//$this->dump($plot->getElements());
	}
}