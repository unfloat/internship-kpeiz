<?php

namespace App\Helpers;

class ChannelStats
{

    // public function __construct(CreateChart $charts)
    // {
    //     $this->charts = $charts;
    // }

    public function getBasicIndicators($metrics)
    {

        foreach ($metrics as $element) {
            $info[$element['label']]['labels'][] = $element['date'];
            $info[$element['label']]['values'][] = $element['value'];
        }

        return $info;
    }

    //Le nombre d’interactions sur les publications (Like+commentaire+partage) sur le nombre de fans X 100.

    //Le taux d’engagement/nombre de publication.

    // public function getFansProgression($metrics)
    // {

    //     foreach ($metrics as $element) {
    //         if ('subscriberCount' == $element['label']) {
    //             $subscriberCount[] = $element['value'];
    //             $time[]            = $element['date'];
    //             continue;
    //         }
    //     }
    //     //dd($time);

    //     return $chart;
    // }

    // public static function getInteractions($metrics)
    // {
    //     //dd($metrics);
    //     foreach ($metrics as $key => $element) {
    //         if ('videoCount' == $element['label']) {
    //             continue;
    //         }
    //         $pieChartData[$element['label']] = $element['value'];
    //     }
    //     //dd($pieChartData);

    //     $piechart = Chart::initChart(str_random(5), 'pie', 'Interactions')
    //         ->addDataSets(array_values($pieChartData))->setLabels(array_keys($pieChartData));
    //     //dd($piechart);

    //     return $piechart;

    //     //DONE
    // }

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
