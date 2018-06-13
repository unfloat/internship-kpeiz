<?php
namespace App\Helpers;
class CreateSpaceChart {

	public function getChart($data, $charts = []) {
		foreach ($charts as $key => $element) {
			$final[] = $this->{$key}($data, $element);
		}
		return $final;
	}

	public function multibar($data, $chart) {
		$results = [];
		$since = app('since');
		$until = app('until');

		foreach ($data as $metric) {
			if (in_array($metric['label'], $chart)) {
				$results[$metric['label']][$metric['date']] = $metric['value'];
			}
		}
		$finalcharts = [];
		foreach ($results as $key => $result) {
			$finalcharts[] = SpaceChart::initChart('multibar', $key)->setLabels(array_keys($result))->addDataSets(array_values($result));
		}
		return $finalcharts;
	}

	public function line($data, $chart) {
		$results = [];
		$since = app('since');
		$until = app('until');
		$loop = true;
		$newData = [];
		foreach ($data as $metric) {
			if (in_array($metric['label'], $chart)) {
				$results[$metric['label']][$metric['date']] = $metric['value'];
			}
		}
		while ($loop) {
			$newData[$until->toDateString()] = '0';
			if ($since->gte($until)) {
				break;
			}
			$until->subDay();
		}
		$finalcharts = [];
		$keys = [];
		foreach ($results as $key => $result) {
			$keys[] = $key;
			foreach ($newData as $k => $v) {
				if (isset($result[$k])) {
					$newData[$k] = $result[$k];
				}
			}
		}

		$newData = array_reverse($newData);

		$finalcharts[] = SpaceChart::initChart('line')->setLabels($keys)->addDataSets(array_values($newData));

		return $finalcharts;
	}

}