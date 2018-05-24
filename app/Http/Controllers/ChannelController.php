<?php

namespace App\Http\Controllers;

use App\Helpers\ChannelStats;
use App\Helpers\CreateChart;

class ChannelController extends Controller
{
    protected $charts;
    protected $channelStats;

    public function __construct(CreateChart $charts, ChannelStats $channelStats)
    {
        $this->charts       = $charts;
        $this->channelStats = $channelStats;
    }

    public function getMetrics()
    {

        $id    = (app('channel')->id);
        $since = app('since');
        $until = app('until');

        $data = app('channel')->load(
            (['channelMetric' => function ($query) use ($since, $until) {
                $query->whereBetween('date', [$since, $until]);},

            ])
        )->toArray();

        //dd($data);

        if (!isset($data)) {
            return redirect()->back();
        }

        $finals[$data['title']] = $this->charts->getChart($data['channel_metric'],
            [
                'bar'  => ['subscriberCount'],
                'line' => ['subscriberCount'],
                'pie'  => ['viewCount', 'subscriberCount', 'commentCount'],

            ]
        );

        $indicators = $this->channelStats->getBasicIndicators($data['channel_metric']);

        //dd($indicators);

        return view('metrics.channelmetrics', compact('indicators', 'finals'));
    }
}
