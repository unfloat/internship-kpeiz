<?php

namespace App\Helpers;

class Chart {
	public $id;
	public $labels;
	public $datasets;
	public $unit;
	public $type;

	public function __construct($container_id, $type, $title) {
		$this->id = $container_id;
		$this->type = $type;
		$this->title = $title;
		$this->unit = 'date';
	}

	public static function initChart($container_id, $type, $title) {
		return (new Chart($container_id, $type, $title));
	}

	public function addDataSets($data) {
		// /dd($data);
		$params = []
		$params = array_merge($this->getConfig($this->title), $params);
		$params['data'] = $data;
		//$params['data'] = $data;
		//case nxLine

		if ('pie' == $this->type) {
			$this->datasets = $params;
		} else {
			$this->datasets[] = $params;
		}

		return $this;
	}

	public function setLabels($labels) {
		$this->labels = $labels;
		return $this;
	}

	public function getConfig() {
		if ('bar' == $this->type) {
			return [
				'label' => $this->title,
				'backgroundColor' => [
					"rgba(255, 159, 64, 0.2)",
					"rgba(241, 194, 5, 0.2)",
					"rgba(99, 203, 137, 0.2)",
					"rgba(0, 112, 224, 0.2)",
					"rgba(153, 102, 255, 0.2)",
					"rgba(201, 203, 207, 0.2)"],
				'borderColor' => [
					"rgb(236, 94, 105)",
					"rgb(255, 159, 64)",
					"rgb(241, 194, 5)",
					"rgb(99, 203, 137)",
					"rgb(0, 112, 224)",
					"rgb(153, 102, 255)",
					"rgb(201, 203, 207)"],
				'borderWidth' => 1,

			];
		}

		if ('line' == $this->type) {
			return [
				'label' => $this->title,
				'lineTension' => 0.3,
				'borderColor' => "rgba(2,117,216,1)",
				'fill' => false,
				'pointRadius' => 5,
				'pointBackgroundColor' => "rgba(2,117,216,1)",
				'pointBorderColor' => "rgba(255,255,255,0.8)",
				'pointHoverRadius' => 5,
				'pointHoverBackgroundColor' => "rgba(2,117,216,1)",
				'pointHitRadius' => 20,
				'pointBorderWidth' => 2,
			];
		}

		if ('pie' == $this->type) {
			return [
				'backgroundColor' => ["rgb(236, 94, 105)",
					"rgb(255, 159, 64)",
					"rgb(241, 194, 5)",
					"rgb(99, 203, 137)"]];
			//'backgroundColor' => ['#007bff', '#dc3545', '#ffc107']];
		}

		return [];
	}
}
