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

class StickCase extends  UnitCase
{
	public function run()
	{
		$this->setTitle('Test de graphique en baton');
		
		$graph = new Chart();
		$graph->setBackgroundColor()->setBorder();
		$graph->setTitle('Good 1.0 - Stick chart');
		$plot = new Stick($graph, 'stick-chart');
		$plot->setColor(Palette::RED);
		$plot->setData(new Data(array(50, -25, 75, 80)))->setLabels(array('50%', '-25%', '75%', '80%'));		
		$graph->plot($plot);
		$plot->axisx->setLabel('Mois');
		$plot->axisy->setLabel("Indice d'écoute");
		$numbers = array(null, null, null, null, null, null, null, null);
		$months = array('Jan', 'Fev', 'Mars', 'Avril');
 		$plot->axisx->tickx->setLabels($months);
		$plot->axisy->ticky->setLabels();
		$graph->generate();
		View::newInstance()->render($graph);
		
		//$this->dump($plot->getElements());
	}
}