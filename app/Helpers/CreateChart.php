<?php
namespace App\Helpers;
class CreateChart {
	public function getChart($data, $charts = []) {

		foreach ($charts as $key => $element) {
			$final[] = $this->{$key}($data, $element);
		}
		return $final;
	}
	public function line($data, $chart) {
		$results = [];
		foreach ($data as $metric) {
			if (in_array($metric['label'], $chart)) {
				$results[$metric['label']][$metric['date']] = $metric['value'];
			}
		}
		$since = app('since');
		$until = app('until');
		$loop = true;
		$newData = [];
		while ($loop) {
			$newData[$until->toDateString()] = '0';
			if ($since->gte($until)) {
				break;
			}
			$until->subDay();
		}
		$finalcharts = [];
		foreach ($results as $key => $result) {
			foreach ($newData as $k => $v) {
				if (isset($result[$k])) {
					$newData[$k] = $result[$k];
				}
			}
			$newData = array_reverse($newData);
			$finalcharts[] = Chart::initChart(str_random(5), 'line', $key)->setLabels(array_keys($newData))->addDataSets(array_values($newData));
		}
		return $finalcharts;
	}
	public function pie($data, $charts) {
		$results = [];
		foreach ($data as $metric) {
			if (in_array($metric['label'], $charts)) {
				$results[$metric['label']] = $metric['value'];
			}
		}
		$finalcharts['Interactions'] = Chart::initChart(str_random(5), 'pie', 'Interactions')->setLabels(array_keys($results))->addDataSets(array_values($results));
		return $finalcharts;
	}
	public function bar($data, $chart) {
		$results = [];
		foreach ($data as $metric) {
			if (in_array($metric['label'], $chart)) {
				$results[$metric['label']][$metric['date']] = $metric['value'];
			}
		}
		$finalcharts = [];
		foreach ($results as $key => $result) {
			$finalcharts[] = Chart::initChart(str_random(5), 'bar', $key)->setLabels(array_keys($result))->addDataSets(array_values($result));
		}
		return $finalcharts;
	}
}