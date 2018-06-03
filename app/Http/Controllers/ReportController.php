<?php

namespace App\Http\Controllers;

use App\Helpers\ChannelStats;
use App\Helpers\CreateChart;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller {
	protected $charts;
	protected $channelStats;

	public function __construct(CreateChart $charts, ChannelStats $channelStats) {
		$this->charts = $charts;
		$this->channelStats = $channelStats;
	}

	public function getReport() {
		$channel = app('channel');

		return view('report', compact('channel'));
	}

	public function downloadPDF(Request $request) {

		$since = app('since');
		$until = app('until');

		$data = app('channel')->load([
			'channelMetric' => function ($query) use ($since, $until) {
				$query->whereBetween('channel_metric.created_at', [$since, $until]);
			},
			'channelData' => function ($query) use ($since, $until) {
				$query->whereBetween('channel_data.created_at', [$since, $until]);
			},

		]
		)->toArray();

		$indicators = $this->channelStats->getBasicIndicators($data['channel_metric']);

		if (!isset($data)) {
			return redirect()->back();
		}

		$thumbnail = $data['data']['thumbnail'];
		$published_at = $data['published_at'];

		//  return view('test',compact('indicators'));

		if ($request->has('download')) {
			$pdf = PDF::loadView('channelreport', compact('indicators', 'thumbnail', 'published_at'));
			return $pdf->download('ChannelMetrics.pdf');
			// return view('test',compact('indicators','thumbnail','published_at'));
		}
	}
}
