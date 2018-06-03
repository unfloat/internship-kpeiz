<?php
namespace App\Http\Controllers;

use App\Jobs\FetchChannel;
use App\User;
use App\Youtube\UrlAdapter;
use Auth;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller {

	public function index() {

		return view('login');
	}

	public function getURL(Request $request) {

		try {

			$channeldata = Auth::user()->channels()->take(10)->get()->toArray();
		} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data ']);
			//dd(app('since'), app('until'));
		}

		return view('dashboard', compact('channeldata'));
	}

	public function postChannel(Request $request) {

		try {
			$data = UrlAdapter::parseChannelFromURL($request->get('urlchannel'));
		} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => $e->getMessage()]);
			return redirect()->back();
		}

		/*('channel' == $data['type']) ? $channeldata = YoutubeAdapter::getChannelbyChannelId($data['channel']) : $channeldata = YoutubeAdapter::getUserChannel($data['channel']);*/
		//dd($channeldata);

		/*dd($data);*/

		$this->dispatch(new FetchChannel($data, Auth::user()));

		Session::flash('msg', ['type' => 'success', 'text' => 'Data is being collected']);
		return redirect('home');
	}

	// public function test()
	// {

	//     $alreadySavedChannels = Channel::all('id', 'user_id')->toArray();

	//     foreach ($alreadySavedChannels as $key => $alreadySavedChannel) {
	//         $channeldata[] = YoutubeAdapter::getChannelbyChannelId($alreadySavedChannel['id']);
	//     }

	//     //dd($channeldata);
	//     foreach ($channeldata as $key => $data) {
	//         //dd($channeldata, $data->items);
	//         YoutubeChannelDAO::saveChannel($data, $alreadySavedChannel['user_id']);
	//     }
	// }
	/*
	     public function test()
	    {
	           ('channel' == $this->data['type']) ? $channeldata = YoutubeAdapter::getChannelbyChannelId($this->data['channel']) : $channeldata = YoutubeAdapter::getUserChannel($this->data['channel']);
	        //dd($channeldata);
	        YoutubeChannelDAO::saveChannel($channeldata, $this->user->id);

*/
}
