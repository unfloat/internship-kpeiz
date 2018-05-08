<?php

namespace App\Http\Controllers;

use App\Helpers\CreateChart;

class UserActivitiesController extends Controller
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

        // $metrics = ChannelMetric::where('channel_id',$id)->get()->unique(function ($item) {
        //   return $item['label'];
        // })->toarray();
        // $metrics = ChannelMetric::where('channel_id',$id)->get()->toarray();
        // $playlists = Playlist::where('channel_id',$id)->whereBetween('created_at', [app('since'),app('until')])->get()->toArray();

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
        //dd($data);

        foreach ($data['videos'] as $key => $video_data) {
            $videos_data[] = $video_data;
            //dd($video_data);
            $finals[$video_data['title']] = $this->charts->getChart($video_data['video_metrics'],
                [
                    'bar'  => ['viewCount'],

                    'line' => ['likeCount'],
                    'pie'  => ['likeCount', 'dislikeCount', 'commentCount'],

                ]);
            // dd($viedo_data['video_metrics']);
        }

        //

        // /dd($video_thumbnail);
        // dd($since, $until, $data['videos']);

        //dd($finals);

        return view('metrics.useractivities', compact('finals', 'videos_data', 'engagement'));
    }

// public static function getVideoMetrics()
    // {
    //   //

//   $id = (app('channel')->id);

//   // $videoMetrics = videoMetric::where('video_id',function($query)
    //   // {
    //   //   $query = Video::where('playlist_id',function($query)
    //   //   {
    //   //     Playlist
    //   //   }
    //   // }
    // }

    public function getBasicIndicators($metrics)
    {

        foreach ($metrics as $element) {
            $info[$element['label']]['labels'][] = $element['date'];
            $info[$element['label']]['values'][] = $element['value'];
        }
        //dd($info);
        return $info;
    }
}

// function getEngagement($metrics)
// {
//     //dd($metrics);
//     $interactions    = 0;
//     $subscriberCount = 0;
//     $videoCount      = 0;

//     foreach ($metrics as $element) {
//         //dd($element['label']);
//         if ('subscriberCount' == $element['label']) {
//             $subscriberCount += $element['value'];
//             dd($subscriberCount);

//             //$time[] = $element['date'];
//             // continue;
//         }
//         if ('likeCount' == $element['label'] || 'commentCount' == $element['label']) {
//             $interactions += $element['value'];
//             $time[]       = $element['date'];
//             $engagement[] = $interactions / ($subscriberCount * 100);
//         }

//         if ('videoCount' == $element['label']) {
//             $videoCount += $element['value'];
//             // continue;
//         }

//         // $sumInteractions += $element['value'];
//     }
//     dd($engagement);
//     // $avgEngagement = $engagement / $videoCount;
//     //dd($engagement);

//     $chart = Chart::initChart(str_random(5), 'line', 'Engagement')->setLabels($time)->addDataSets($subscriberCount);

//     //dd($chart);

//     return $chart;
// }

//     public function getEngagement($metrics)
//     {
//         //dd($metrics);
//         $interactions    = 0;
//         $subscriberCount = 0;
//         $videoCount      = 0;

//         foreach ($metrics as $element) {
//             //dd($element['label']);
//             if ('subscriberCount' == $element['label']) {
//                 $subscriberCount += $element['value'];
//                 //dd($subscriberCount);

//                 //$time[] = $element['date'];
//                 // continue;
//             }
//             if ('commentCount' == $element['label']) {
//                 $interactions += $element['value'];
//                 $time[]       = $element['date'];
//                 $engagement[] = $interactions / ($subscriberCount * 100);
//             }

//             if ('videoCount' == $element['label']) {
//                 $videoCount += $element['value'];
//                 // continue;
//             }

//             // $sumInteractions += $element['value'];
//         }
//         //dd($engagement);
//         // $avgEngagement = $engagement / $videoCount;
//         //dd($engagement);

//         $chart = Chart::initChart(str_random(5), 'line', 'Engagement')->setLabels($time)->addDataSets($subscriberCount);

//         //dd($chart);

//         return $chart;
//     }

// //Le nombre d’interactions sur les publications (Like+commentaire+partage) sur le nombre de fans X 100.

// //Le taux d’engagement/nombre de publication.

// //FANS : PROGRESSION

//     public function getFansProgression($metrics)
//     {
//         //
//         //dd($metrics);
//         foreach ($metrics as $key => $element) {
//             //dd($element['values']);
//             if ('subscriberCount' == $key) {
//                 $subscriberCount[] = $element['values'];
//                 $time[]            = $element['labels'];
//                 continue;
//             }
//             //$time[] = $element['labels'];
//         }

//         $chart = self::getLineChart($subscriberCount, $time);
//         //dd($chart);

//         return $chart;
//     }

//     public function getLineChart($engagement, $time)
//     {

//         $chart = Chart::initChart(str_random(5), 'line', 'Subscribers Progression')->setLabels(array_values($time))->addDataSets(array_values($engagement));

//         return $chart;
//     }

//     public function getEngagementLineChart($metrics)
//     {
//         //dd($metrics);

//         foreach ($metrics as $key => $value) {
//             //dd($value['labels']);
//             $labels[] = $value['labels'];
//             $values[] = $value['values'];
//         }

//         $chart = Chart::initChart(str_random(5), 'line', 'Engagement')->setLabels(array_values($labels))->addDataSets(array_values($values));
//         //dd($chart);

//         return $chart;
//     }

//     public function getPieChart($metrics)
//     {
//         // $labels;
//         // $data;
//         // $pieChartData=array();
//         foreach ($metrics as $key => $element) {
//             //dd($element);
//             if ('videoCount' == $key) {
//                 continue;
//             }
//             $pieChartData[$key] = $element['values'];
//         }

//         $piechart = Chart::initChart(str_random(5), 'pie', 'Interactions')
//             ->addDataSets(array_values($pieChartData))->setLabels(array_keys($pieChartData));
//         //dd($piechart);

//         return $piechart;
//     }
// };
