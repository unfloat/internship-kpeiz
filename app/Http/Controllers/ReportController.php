<?php
namespace App\Http\Controllers;
use App\Helpers\ChannelStats;
use App\Helpers\CreateChart;
use App\Helpers\VideoStats;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller {
	protected $charts;
	protected $channelStats;
	protected $videoStats;
	public function __construct(CreateChart $charts, ChannelStats $channelStats, VideoStats $videoStats) {
		$this->charts = $charts;
		$this->channelStats = $channelStats;
		$this->videoStats = $videoStats;
	}
	public function getReport() {
		$channel = app('channel');
		return view('report', compact('channel'));
	}

/*	public function downloadPDF(Request $request) {

if ($request->has('download')) {
$pdf = PDF::loadView($activeView);
return $pdf->download('ChannelMetrics.pdf');
}

}*/

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
			$pdf = PDF::loadView('channelreport', get_defined_vars());
			return $pdf->download('ChannelMetrics.pdf');
			// return view('test',compact('indicators','thumbnail','published_at'));
		}
	}

	public function downloadPDFVideo(Request $request) {
		$since = app('since');
		$until = app('until');
		$id = app('video')->id;

		$data = app('channel')->load(
			[
				'videos' => function ($query) use ($since, $until, $id) {
					$query->where('videos.id', $id)->whereBetween('videos.created_at', [$since, $until]);
				}]
		)->toArray();

		foreach ($data['videos'] as $key => $videodata) {
			$indicators = $this->videoStats->getBasicIndicators($videodata['video_metrics']);
		}

		$thumbnail = $data['data']['thumbnail'];
		$published_at = $data['published_at'];

		if ($request->has('download')) {
			$pdf = PDF::loadView('videoreport', get_defined_vars());
			return $pdf->download('videometrics.pdf');

		}

	}
}
