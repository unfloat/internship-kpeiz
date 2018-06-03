<?php

namespace App\Http\Controllers;
use PDF;

class ChannelActivitiesController extends Controller {
	//

	public function getReport() {
		$channel = app('channel');

		return view('report', compact('channel'));
	}

	public function downloadPDF() {

		$channel = app('channel');

		$pdf = PDF::loadView('metrics.channelmetrics', $channel);
		return $pdf->download('report.pdf');

	}

}