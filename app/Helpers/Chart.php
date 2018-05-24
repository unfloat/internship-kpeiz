<?php

namespace App\Helpers;

class Chart
{
    public $id;
    public $labels;
    public $datasets;
    public $unit;
    public $type;

    public function __construct($container_id, $type, $title)
    {
        $this->id    = $container_id;
        $this->type  = $type;
        $this->title = $title;
        $this->unit  = 'date';
    }

    public static function initChart($container_id, $type, $title)
    {
        return (new Chart($container_id, $type, $title));
    }

    public function addDataSets($data, $params = [])
    {
        // /dd($data);
        $params         = array_merge($this->getConfig($this->title), $params);
        $params['data'] = $data;
        //$params['data'] = $data;
        //case nxLine

        if ('pie' == $this->type) {
            $this->datasets = $params;
        } else {
            $this->datasets[] = $params;
        }

        return $this;
    }

    public function setLabels($labels)
    {
        $this->labels = $labels;
        return $this;
    }

    public function getConfig()
    {
        if ('bar' == $this->type) {
            return [
                'label'           => $this->title,
                'backgroundColor' => "rgba(2,117,216,1)",
                'borderColor'     => "rgba(2,117,216,1)",

            ];
        }

        if ('line' == $this->type) {
            return [
                'label'                     => $this->title,
                'lineTension'               => 0.3,
                'borderColor'               => "rgba(2,117,216,1)",
                'fill'                      => false,
                'pointRadius'               => 5,
                'pointBackgroundColor'      => "rgba(2,117,216,1)",
                'pointBorderColor'          => "rgba(255,255,255,0.8)",
                'pointHoverRadius'          => 5,
                'pointHoverBackgroundColor' => "rgba(2,117,216,1)",
                'pointHitRadius'            => 20,
                'pointBorderWidth'          => 2,
            ];
        }

        if ('pie' == $this->type) {
            return [
                'backgroundColor' => ['#007bff', '#dc3545', '#ffc107', '#28a745']];
            //'backgroundColor' => ['#007bff', '#dc3545', '#ffc107']];
        }

        return [];
    }
}
