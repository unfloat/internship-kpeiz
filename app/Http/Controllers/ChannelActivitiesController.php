<?php

namespace App\Http\Controllers;

use App\Helpers\CreateChart;

class ChannelActivitiesController extends Controller
{
    //

    protected $charts;

    public function __construct(CreateChart $charts)
    {
        $this->charts = $charts;
    }

    public function getMetrics()
    {

        $id    = (app('channel')->id);
        $since = app('since');
        $until = app('until');
        //dd($id);
        // $metrics = ChannelMetric::where('channel_id',$id)->get()->unique(function ($item) {
        //     return $item['date'].$item['label'];
        // })->toarray();

        $data = app('channel')->load(
            (['channelMetric' => function ($query) use ($since, $until) {
                $query->whereBetween('date', [$since, $until]);
            }, 'videos' => function ($query) use ($since, $until) {
                $query->whereBetween('videos.published_at', [$since, $until]);
            }, 'playlists' => function ($query) use ($since, $until) {
                $query->whereBetween('published_at', [$since, $until]);
            },

            ])
        )->toArray();

        // $test = $data->toArray();
        //dd($data, $since, $until);

        $charts[] = $this->charts->getChart($data['channel_metric'],
            [

                'line' => ['viewCount', 'commentCount'],
                'pie'  => ['viewCount', 'subscriberCount', 'commentCount'],
                // ['line' => 'subscriberCount'],

            ]
        );

        //dd($charts);
        return view('metrics.channelactivities', compact('charts'));
    }

    // public static function getPlaylistLineChart($metrics)
    // {
    //     //dd($metrics);
    //     foreach ($metrics as $element) {
    //         $chartData[$element['label']]['labels'][] = $element['date'];
    //         $chartData[$element['label']]['values'][] = $element['value'];
    //     }
    //     $chart = [];
    //     foreach ($chartData as $key => $chartelem) {
    //         $chart[$key] = Chart::initChart(str_random(5), 'line', 'Videos')->addDataSets($chartelem['values'])->setLabels($chartelem['labels']);
    //     }

    //     return $chart;
    // }

    // public static function getLineChart($engagement, $time)
    // {

    //     $chart = Chart::initChart(str_random(5), 'line', 'Engagement')->setLabels($time)->addDataSets($engagement);

    //     return $chart;
    // }

    // public static function getEngagementLineChart($metrics)
    // {
    //     //dd($metrics);

    //     foreach ($metrics as $key => $value) {
    //         //dd($value['labels']);
    //         $labels[] = $value['labels'];
    //         $values[] = $value['values'];
    //     }

    //     $chart = Chart::initChart(str_random(5), 'line', 'Engagement')->setLabels(array_values($labels))->addDataSets(array_values($values));
    //     //dd($chart);

    //     return $chart;
    // }

    // public static function getChannelBestActivities($videoMetrics)
    // {
    //     $videoCollection = collect($videoMetrics);

    //     $bestVideos = $videoCollection->sortBy('videos.metrics.likeCount');
    //     $bestVideosByPlaylist = $bestVideos->groupBy('playlist_id');

    //     foreach ($bestVideosByPlaylist as $key => $value) {
    //         dd($key);
    //         $bestPlaylists[] = PlaylistData::where('playlist_id',$key)->get()->toArray();
    //         // ->whereBetween('published_at',[app('since'),app('until')])
    //         dd($bestPlaylists);
    //     }
    //     //$bestVideosByPlaylist[] = $bestPlaylists;
    //     // $bestPosts = [$bestVideosByPlaylist,$bestPlaylists];

    //     return $bestPlaylists;

    //     // return $bestPosts;

    // }

    // public static function getChannelBestPlaylists($bestVideos)
    // {
    // }

    // public static function getVideoLineChart($metrics)
    // {
    //     //dd($metrics);
    //     foreach ($metrics as $element) {
    //         dd($element);

    //         $chartData[$element['labels']]['labels'][] = $element['date'];
    //         $chartData[$element['labels']]['values'][] = $element['value'];
    //     }
    //     $chart = [];
    //     foreach($chartData as $key => $chartelem)
    //     {

    //         $chart[$key] = Chart::initChart(str_random(5),'line','Videos')->addDataSets($chartelem['values'])->setLabels($chartelem['labels']);
    //     }

    //     return $chart;
    // }
}
