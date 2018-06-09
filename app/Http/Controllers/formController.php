<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;

class formController extends Controller {
	//
	public function updateDate(Request $request) {
		Session::put('since', $request->start_date);
		Session::put('until', $request->end_date);
		Session::flash('msg', ['type' => 'success', 'text' => 'Periode fixée']);

		Session::save();
		return redirect()->back();
	}
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