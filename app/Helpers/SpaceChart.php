<?php
namespace App\Helpers;
class SpaceChart {
	public $labels;
	public $datasets;
	public $type;

	public function __construct($type) {

		$this->type = $type;
	}
	public static function initChart($type) {
		return (new SpaceChart($type));
	}
	public function addDataSets() {

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