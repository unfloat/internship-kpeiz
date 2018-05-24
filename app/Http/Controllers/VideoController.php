<?php

namespace App\Http\Controllers;

use App\Helpers\CreateChart;
use App\Helpers\VideoStats;

class VideoController extends Controller
{
    //

    protected $charts;
    protected $videoStats;

    public function __construct(CreateChart $charts, VideoStats $videoStats)
    {
        $this->charts     = $charts;
        $this->videoStats = $videoStats;
    }

    public function getMetrics()
    {
        $id    = (app('channel')->id);
        $since = app('since');
        $until = app('until');

        // $data = app('channel')->load(
        //     (['channelMetric' => function ($query) use ($since, $until) {
        //         $query->whereBetween('date', [$since, $until]);
        //     }, 'videos' => function ($query) use ($since, $until) {
        //         $query->whereBetween('videos.published_at', [$since, $until]);
        //     }, 'playlists' => function ($query) use ($since, $until) {
        //         $query->whereBetween('published_at', [$since, $until]);
        //     },
        //     ])
        // )->toArray();

        // dd(app('playlist')->title);

        $videodata = app('playlist')->load(
            (
                ['videos' => function ($query) use ($since, $until) {
                    $query->whereBetween('videos.created_at', [$since, $until]);},

                ])
        )->toArray();

        //dd($videodata, $since, $until);
        // try {
        //dd($videodata);

        foreach ($videodata['videos'] as $key => $data) {
            $videos[$data['title']] = $data['data']['thumbnail'];

            $finals[$data['id']] = $this->charts->getChart($data['video_metrics'],
                [
                    'bar'  => ['viewCount'],

                    'line' => ['likeCount', 'dislikeCount'],
                    'pie'  => ['likeCount', 'dislikeCount'],

                ]);
        }

        //dd($videos, $finals);

        //dd($videos);
        // } catch (\Exception $e) {
        //     Session::flash('msg', ['type' => 'danger', 'text' => $e->getMessage()]);
        //     return redirect()->back();
        // }

        return view('metrics.videometrics', compact('finals', 'videos'));
    }
}
