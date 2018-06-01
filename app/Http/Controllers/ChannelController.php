<?php

namespace App\Http\Controllers;

use App\Helpers\ChannelStats;
use App\Helpers\CreateChart;
use Session;

class ChannelController extends Controller {
	protected $charts;
	protected $channelStats;

	public function __construct(CreateChart $charts, ChannelStats $channelStats) {
		$this->charts = $charts;
		$this->channelStats = $channelStats;
	}

	public function getMetrics() {

		/*dd(app('since'), app('until'));*/

		$id = (app('channel')->id);
		$since = app('since');
		$until = app('until');

		$data = app('channel')->load([
			'channelMetric' => function ($query) use ($since, $until) {
				$query->whereBetween('channel_metric.created_at', [$since, $until]);},
			'channelData' => function ($query) use ($since, $until) {
				$query->whereBetween('channel_data.created_at', [$since, $until]);},

		]
		)->toArray();

		try {

			$finals[$data['title']] = $this->charts->getChart($data['channel_metric'],
				[
					'bar' => ['subscriberCount'],
					'line' => ['viewCount'],
					'pie' => ['viewCount', 'subscriberCount'],

				]
			);

			$indicators = $this->channelStats->getBasicIndicators($data['channel_metric']);
			//dd($indicators);
		} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data During this period ']);
			/*return redirect()->back();*/
		}

		//dd($data);

		if (!isset($data)) {
			return redirect()->back();
		}

		return view('metrics.channelmetrics', compact('indicators', 'finals'));
	}
}
