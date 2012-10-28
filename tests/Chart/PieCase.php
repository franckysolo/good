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

class PieCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle('Test de graphique en camembert');
		
		$graph = new Chart();
		$graph->setBackgroundColor()->setBorder();
		$graph->setTitle('Good 1.0 - Pie chart');
		$plot = new Pie($graph, 'pie-chart');
		$plot->setColor(Palette::RED);
		$plot->setData(new Data(array(50, 25, 75, 80, 50, 50, 50, 50, 10, 20, 10, 20)))->setLabels();
		$graph->plot($plot);
		$graph->generate();
		View::newInstance()->render($graph);
		
		//$this->dump($plot->getElements());
	}
}