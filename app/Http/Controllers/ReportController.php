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

		if ($request->has('download')) {
			$pdf = PDF::loadView($activeView);
			return $pdf->download('ChannelMetrics.pdf');
		}

	}
}
