<?php

namespace App\Http\Controllers;

use App\Helpers\CreateChart;
use App\Helpers\VideoStats;
use Carbon\Carbon;
use Session;

class VideoController extends Controller {
	//

	protected $charts;
	protected $videoStats;
	protected $activeVideo;
	protected $spacecharts;

	public function __construct(CreateChart $charts, VideoStats $videoStats) {
		$this->charts = $charts;
		$this->videoStats = $videoStats;

	}

	public function getVideos($id = null) {

		$since = app('since');
		$until = app('until');
		$savedPlaylists = app('savedPlaylists');

		try {

			if (isset($id)) {
				Session::put('playlist_id', $id);
				Session::save();

				$videodata = app('playlist')->load(
					['videos' => function ($query) use ($since, $until) {
						$query->whereBetween('videos.created_at', [$since, $until]);
					}]
				)->toArray();
			} else {
				$videodata = app('channel')->load(
					['videos' => function ($query) use ($since, $until) {
						$query->whereBetween('videos.created_at', [$since, $until]);
					}]
				)->toArray();
			}

		} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => 'Aucune information durant' . $since->toDateString() . ' ' . $until->toDateString()]);
		}

		return view('videos', compact('videodata', 'savedPlaylists'));

	}

	public function getMetrics($id) {
		/*$id = (app('channel')->id);*/
		$since = app('since');
		$until = app('until');
		$savedVideos = app('savedVideos');

		Session::put('video_id', $id);
		Session::save();

		try {

			$data = app('channel')->load(
				[
					'videos' => function ($query) use ($since, $until, $id) {
						$query->where('videos.id', $id)->whereBetween('videos.created_at', [$since, $until]);
					}]
			)->toArray();

			if ($data['videos'] == []) {
				Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data During this period ' . Carbon::parse(($since)) . ' to ' . Carbon::parse($until)]);
			} else {

				foreach ($data['videos'] as $key => $videodata) {

					$finals[] = $this->charts->getChart($videodata['video_metrics'],
						[
							'bar' => ['viewCount', 'likeCount'],
							'pie' => ['likeCount', 'dislikeCount', 'commentCount'],
							'line' => ['likeCount', 'viewCount'],

						]);

					$indicators = $this->videoStats->getBasicIndicators($videodata['video_metrics']);
				}

			}

		} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => $e->getMessage()]);
			return redirect()->back();
		}

		return view('metrics.videometrics', compact('finals', 'indicators', 'savedVideos'));
	}

}
