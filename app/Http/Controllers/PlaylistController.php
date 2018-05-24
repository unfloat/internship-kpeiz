<?php

namespace App\Http\Controllers;

use App\Helpers\CreateChart;
use App\Helpers\PlaylistStats;

class PlaylistController extends Controller
{
    //
    protected $charts;
    protected $playlistStats;

    public function __construct(CreateChart $charts, PlaylistStats $playlistStats)
    {
        $this->charts        = $charts;
        $this->playlistStats = $playlistStats;
    }

    public function getMetrics()
    {

        $since = app('since');
        $until = app('until');

        //dd(app('playlist'));

        try {

            $playlistsData = app('playlist')->load(

                ['playlistMetric' => function ($query) use ($since, $until) {
                    $query->whereBetween('playlist_metric.created_at', [$since, $until]);
                },
                    'playlistData'    => function ($query) use ($since, $until) {
                        $query->whereBetween('playlist_data.created_at', [$since, $until]);
                    },
                ])->toArray();

        } catch (\Exception $e) {
            Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data ']);
            //dd(app('since'), app('until'));
        }

        dd($playlistdata, $since, $until);

        $playlist[$playlistsData['title']] = $playlistsData['data']['thumbnail'];
        $indicators                        = $this->playlistStats->getBasicIndicators($playlistsData['playlist_metric']);

        //dd($playlistsData);

        return view('metrics.playlistmetrics', compact('playlist', 'indicators'));
    }
};
