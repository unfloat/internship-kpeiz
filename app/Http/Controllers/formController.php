<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class formController extends Controller {
	//

	public function updateDate(Request $request) {

		Session::put('since', $request->start_date);
		Session::put('until', $request->end_date);

		Session::save();

		return redirect()->back();
	}

	// public function putPeriod(Request $request)
	// {
	//     // $day =
	//     if (isset($request->day)) {
	//         Session::put('period', 'test');
	//     }

	//     Session::save();
	//     return view('dashboard');
	// }

	// public function setVideo(Request $request)
	// {
	//     $videos =
	//     return redirect()->back();
	// }

	//sets the active channel (session variable) to the selected channel in the dropdown menu
	public function setAccount(Request $request) {
		Session::put('channel_id', $request->id);
		Session::save();

		return redirect()->back();
	}

	public function setPlaylist(Request $request) {

		Session::put('playlist_id', $request->id);
		Session::save();

		return redirect()->back();
	}
}
