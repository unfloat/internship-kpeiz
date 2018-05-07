<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Chart;

class ChartController extends Controller
{
    //

	public static function getLineChart($engagement,$time)
	{
		
		$chart = Chart::initChart(str_random(5),'line','Engagement')->setLabels($time)->addDataSets($engagement);
		
		return $chart;
	}

	public static function getEngagementLineChart($metrics)
	{
		//dd($metrics);

		foreach ($metrics as $key => $value) {
			//dd($value['labels']);
			$labels[] = $value['labels'];
			$values[] = $value['values'];
			
		}
		
		$chart = Chart::initChart(str_random(5),'line','Engagement')->setLabels(array_values($labels))->addDataSets(array_values($values));
		//dd($chart);
		
		return $chart;
	}

		public static function getPieChart($metrics)
	{
		// $labels;
		// $data;
		// $pieChartData=array();
		foreach ($metrics as $key => $element) {
			//dd($element);
			if ($key == 'videoCount')
			{
				continue;
			}
			$pieChartData[$key] = $element['value'];
			
		}

		$piechart = Chart::initChart(str_random(5),'pie','Interactions')
		->addDataSets(array_values($pieChartData))->setLabels(array_keys($pieChartData));
		//dd($piechart);

		return $piechart;
		

		
	}



	
	// public static function getAverageEngagementLineChart($engagement,$time)
	// {
	// 		// $data = $engagement;
	// 		// $label = $time;
	// 		// dd($data);
	// 		$chart = Chart::initChart(str_random(5),'line','Engagement')->setLabels($time)->addDataSets($engagement);
	// 		//)->addDataSets($data)->addDataSets($data);


	// 	dd($chart);

	// 	return $chart;
	// }


}
