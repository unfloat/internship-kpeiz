<?php

namespace App\Helpers;

class CreateChart
{

    public function getChart($data, $charts = [])
    {
        //dd($charts);
        foreach ($charts as $key => $element) {
            $final[] = $this->{$key}($data, $element);
        }
        return $final;
    }

    public function line($data, $chart)
    {

        $results = [];
        //dd($data);
        foreach ($data as $metric) {
            //dd($metric);
            if (in_array($metric['label'], $chart)) {
                //     // if (array_key_exists($metric['label'], $chart) {
                $results[$metric['label']][$metric['date']] = $metric['value'];
                // }
            }
        }

        //dd($results);
        $finalcharts = [];
        foreach ($results as $key => $result) {
            //dd($key);
            $finalcharts[] = Chart::initChart(str_random(5), 'line', $key)->setLabels(array_keys($result))->addDataSets(array_values($result));
        }
        //dd($finalcharts);
        return $finalcharts;
    }

    public function pie($data, $charts)
    {
        $results = [];
        //dd($data);

        foreach ($data as $metric) {
            if (in_array($metric['label'], $charts)) {
                $results[$metric['label']] = $metric['value'];
            }
        }
        //dd($results);

        $finalcharts['Interactions'] = Chart::initChart(str_random(5), 'pie', 'Interactions')->setLabels(array_keys($results))->addDataSets(array_values($results));

        //dd($finalcharts);
        return $finalcharts;
    }

    public function bar($data, $chart)
    {

        $results = [];
        //dd($data);
        foreach ($data as $metric) {
            //dd($metric);
            if (in_array($metric['label'], $chart)) {
                //     // if (array_key_exists($metric['label'], $chart) {
                $results[$metric['label']][$metric['date']] = $metric['value'];
                // }
            }
        }

        //dd($results);
        $finalcharts = [];
        foreach ($results as $key => $result) {
            $finalcharts[] = Chart::initChart(str_random(5), 'bar', $key)->setLabels(array_keys($result))->addDataSets(array_values($result));
        }
        //dd($finalcharts);
        return $finalcharts;
    }
}