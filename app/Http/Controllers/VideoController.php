<?php

namespace App\Http\Controllers;

use App\Helpers\ActiveMetrics;
use App\Helpers\CreateChart;
use App\Helpers\VideoStats;
use Session;

class VideoController extends Controller {
	//

	protected $charts;
	protected $videoStats;
	protected $activeVideo;

	public function __construct(CreateChart $charts, VideoStats $videoStats, ActiveMetrics $activeVideo) {
		$this->charts = $charts;
		$this->videoStats = $videoStats;
		$this->activeVideo = $activeVideo;
	}

	public function getVideos($id = null) {

		$since = app('since');
		$until = app('until');
		$savedPlaylists = app('savedPlaylists');

		/*if (isset($playlist)) {*/

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
			Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data During this period ']);
			/*return redirect()->back();*/
		}

		/*} else {
			$videodata = app('channel')->load(
				['videos' => function ($query) use ($since, $until) {
					$query->whereBetween('videos.created_at', [$since, $until]);
				}]
			)->toArray();
		}*/

		/*$subscribersCount = $videodata['metrics']['subscriberCount'];
			foreach ($videodata['videos'] as $key => $data) {

				$rank = $this->videoStats->getRank($data['metrics'], $subscribersCount);

				$videodata['videos'][$key]['rank'] = $rank;
		*/

		return view('videos', compact('videodata', 'savedPlaylists'));

	}

	public function getMetrics($id) {
		/*$id = (app('channel')->id);*/
		$since = app('since');
		$until = app('until');
		$savedVideos = app('savedVideos');

		Session::put('video_id', $id);
		Session::save();

		$data = app('channel')->load(
			[
				'videos' => function ($query) use ($since, $until, $id) {
					$query->where('videos.id', $id)->whereBetween('videos.created_at', [$since, $until]);
				}]
		)->toArray();

		if ($data['videos'] == []) {
			Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data During this period ']);
		}

		/*dd($data);*/

		foreach ($data['videos'] as $key => $videodata) {
			$videos[$videodata['title']] = $videodata['data']['thumbnail'];

			$finals[$videodata['id']] = $this->charts->getChart($videodata['video_metrics'],
				[
					'bar' => ['viewCount'],
					'pie' => ['likeCount', 'dislikeCount', 'commentCount'],

					'line' => ['likeCount', 'viewCount'],

				]);

			$indicators[$videodata['title']] = $this->videoStats->getBasicIndicators($videodata['video_metrics']);
		}

		// } catch (\Exception $e) {
		//     Session::flash('msg', ['type' => 'danger', 'text' => $e->getMessage()]);
		//     return redirect()->back();
		// }

		return view('metrics.videometrics', compact('finals', 'videos', 'indicators', 'savedVideos'));
	}
}
