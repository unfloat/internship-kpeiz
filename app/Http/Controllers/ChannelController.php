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

	public function getMetrics($id = null) {

		/*dd(app('since'), app('until'));*/

		$since = app('since');
		$until = app('until');

		Session::put('channel_id', $id);
		Session::save();
		try {
			if (isset($id)) {

				$data = app('channel')->load([
					'channelMetric' => function ($query) use ($since, $until) {
						$query->whereBetween('channel_metric.created_at', [$since, $until]);},
					'channelData',
				]
				)->toArray();
			} else {
				$data = app('channel')->load([
					'channelMetric' => function ($query) use ($since, $until) {
						$query->whereBetween('channel_metric.created_at', [$since, $until]);},
					'channelData',
				]
				)->toArray();
			}

			$finals[$data['title']] = $this->charts->getChart($data['channel_metric'],
				[
					'bar' => ['subscriberCount'],
					'pie' => ['subscriberCount', 'viewCount', 'videoCount'],
					'line' => ['viewCount'],

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

	public function downloadPDF($id = null) {

		$pdf = PDF::loadView('videometrics/' . $id);
		$pdf->download('videometrics.pdf');

		return redirect()->back();
	}
}
