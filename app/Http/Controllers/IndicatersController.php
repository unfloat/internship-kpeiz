<?php

namespace App\Http\Controllers;

use App\Helpers\CreateChart;

// use App\Http\Controllers\ChartController;

class IndicatersController extends Controller
{
    protected $charts;

    public function __construct(CreateChart $charts)
    {
        $this->charts = $charts;
    }

    // public function ayfct()
    // {
    //     $chart = new SampleChart;
    //     $chart->dataset('Sample', 'line', [100, 65, 84, 45, 90]);

    //     return view('metrics.test_chart', compact('chart'));
    // }

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

        $finals[$data['title']] = $this->charts->getChart($data['channel_metric'],
            [
                'bar'  => ['subscriberCount'],
                'line' => ['subscriberCount'],
                'pie'  => ['viewCount', 'subscriberCount', 'commentCount'],

            ]
        );

        //dd($finals);

        $indicators = $this->getBasicIndicators($data['channel_metric']);

        return view('metrics.channelmetrics', compact('indicators', 'finals'));
    }

    public function getBasicIndicators($metrics)
    {

        foreach ($metrics as $element) {
            $info[$element['label']]['labels'][] = $element['date'];
            $info[$element['label']]['values'][] = $element['value'];
        }
        //dd($metrics);
        return $info;
    }

    //Le nombre d’interactions sur les publications (Like+commentaire+partage) sur le nombre de fans X 100.

    //Le taux d’engagement/nombre de publication.

    public function getFansProgression($metrics)
    {

        foreach ($metrics as $element) {
            if ('subscriberCount' == $element['label']) {
                $subscriberCount[] = $element['value'];
                $time[]            = $element['date'];
                continue;
            }
        }
        //dd($time);
        $chart = Chart::initChart(str_random(5), 'line', 'FansProgression')->setLabels(array_values($time))->addDataSets(array_values($subscriberCount));

        return $chart;
    }

    public static function getInteractions($metrics)
    {
        //dd($metrics);
        foreach ($metrics as $key => $element) {
            if ('videoCount' == $element['label']) {
                continue;
            }
            $pieChartData[$element['label']] = $element['value'];
        }
        //dd($pieChartData);

        $piechart = Chart::initChart(str_random(5), 'pie', 'Interactions')
            ->addDataSets(array_values($pieChartData))->setLabels(array_keys($pieChartData));
        //dd($piechart);

        return $piechart;

        //DONE
    }

    // public static function getEngagementLineChart($metrics)
    // {
    //     //dd($metrics);

    //     foreach ($metrics as $key => $value) {
    //         //dd($value['labels']);
    //         $labels[] = $value['labels'];
    //         $values[] = $value['values'];

    //     }

    //     $chart = Chart::initChart(str_random(5),'line','Engagement')->setLabels(array_values($labels))->addDataSets(array_values($values));
    //     //dd($chart);

    //     return $chart;
    // }
}
