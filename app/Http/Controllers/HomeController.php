<?php
namespace App\Http\Controllers;

use App\Jobs\FetchChannel;
use App\User;
use App\Youtube\UrlAdapter;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function getURL(Request $request)
    {
        $channeldata = Auth::user()->channels()->take(10)->get()->toArray();
        // dd(app('since'), app('until'));

        return view('dashboard', compact('channeldata'));
    }

    public function postChannel(Request $request)
    {

        if (!$request->has('urlchannel')) {
            dd('er');
            return view('dashboard');
        }

        $data = UrlAdapter::parseChannelFromURL($request->get('urlchannel'));
        //dd($data);
        // ('channel' == $data['type']) ? $channeldata = YoutubeAdapter::getChannelbyChannelId($data['channel']) : $channeldata = YoutubeAdapter::getUserChannel($data['channel']);

        // //dd(Auth::id());
        // YoutubeChannelDAO::saveChannel($channeldata, Auth::id());

        $this->dispatch(new FetchChannel($data, Auth::user()));
        // Session::put('collecting','Channel data are being collected',1);

        return redirect('dashboard');
    }

    // public function test()
    // {
    //     $alreadySavedChannels = Channel::all('id', 'user_id')->toArray();

    //     foreach ($alreadySavedChannels as $alreadySavedChannel) {
    //         $channeldata = YoutubeAdapter::getChannelbyChannelId($alreadySavedChannel['id']);

    //         $test = YoutubeChannelDAO::saveChannel($channeldata, $alreadySavedChannel['user_id']);
    //     }
    //     //dd($test);
    // }
}
