<?php
namespace App\Helpers;
class SpaceChart {
	public $id;
	public $labels;
	public $datasets;
	public $type;
	public function __construct($container_id, $type) {
		$this->id = $container_id;
		$this->type = $type;
	}
	public static function initChart($container_id, $type) {
		return (new SpaceChart($container_id, $type));
	}
	public function addDataSets($data, $params = []) {
		$params['data'] = $data;
		$this->datasets[] = $params;
		return $this;
	}
	public function setLabels($labels) {
		$this->labels[] = $labels;
		return $this;
	}
	/*public function addKeys($keys)
		{
			$this->keys = $keys;
			return $this;
	*/
	/*public function getConfig() {
		if ('line' == $this->type) {

		}*/
	/*if ('cumulativeLine' == $this->type) {
			return [
			];
		}
		if ('stackedArea' == $this->type) {
			return [
			];
		}
		if ('groupStackedbar' == $this->type) {
			return [
			];
		}*/
	/*		return [];
	}*/
}