<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;

class formController extends Controller
{
    //

    public function updateDate(Request $request)
    {

        Session::put('since', $request->start_date);
        Session::put('until', $request->end_date);

        Session::save();

        $channeldata = Auth::user()->channels()->take(10)->get();
        //dd($view);

        return view('dashboard', compact($channeldata));
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

    // public function pickFromSavedChannels(Request $request)
    // {
    //     Session::put('channel', $request->pichedSavedChannel);
    //     Session::save();
    //     return view('dashboard', compact(app('channel')));
    // }

    public function setAccount(Request $request)
    {
        if (!$request->has('id')) {
            dd('error');
        }
        //dd($request->all());
        Session::put('channel_id', $request->id);

        return redirect('dashboard');
    }
}
