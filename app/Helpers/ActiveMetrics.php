<?php

namespace App\Helpers;

class ActiveMetrics {

	public function getActive($type, $since, $until) {
		if ($type == 'channel') {
			$activeData = app('channel')->load(
				(['channelMetric' => function ($query) use ($since, $until) {
					$query->whereBetween('date', [$since, $until]);},

				])
			)->toArray();

		} elseif ($type == 'playlist') {
			$activeData = app('playlist')->load(

				['playlistMetric' => function ($query) use ($since, $until) {
					$query->whereBetween('playlist_metric.created_at', [$since, $until]);
				},
					'playlistData' => function ($query) use ($since, $until) {
						$query->whereBetween('playlist_data.created_at', [$since, $until]);
					},
				])->toArray();

		} elseif ($type == 'video') {
			$activeData = app('video')->load(
				(
					['videoMetrics' => function ($query) use ($since, $until) {
						$query->whereBetween('videos.created_at', [$since, $until]);
					},
						'videoData' => function ($query) use ($since, $until) {
							$query->whereBetween('videos.created_at', [$since, $until]);},

					])
			)->toArray();
		}

		return $activeData;

	}
}