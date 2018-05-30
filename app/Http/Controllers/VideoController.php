<?php

namespace App\Http\Controllers;

use App\Helpers\ActiveMetrics;
use App\Helpers\CreateChart;
use App\Helpers\VideoStats;

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

	public function getVideos() {
		$since = app('since');
		$until = app('until');

		$videodata = app('channel')->load(
			['videos' => function ($query) use ($since, $until) {
				$query->whereBetween('videos.created_at', [$since, $until]);
			}]
		)->toArray();

		/*dd($videodata);*/

		return view('videos', compact('videodata'));

	}

	public function getMetrics($id) {
		/*$id = (app('channel')->id);*/
		$since = app('since');
		$until = app('until');

/*		if ($request->get('id')) {

Session::put('video_id', $request->id);

}*/

		$data = app('channel')->load(
			[
				'videos' => function ($query) use ($since, $until, $id) {
					$query->where('videos.id', $id)->whereBetween('videos.created_at', [$since, $until]);
				}]
		)->toArray();

		//dd($data);

		foreach ($data['videos'] as $key => $videodata) {
			$videos[$videodata['title']] = $videodata['data']['thumbnail'];

			$finals[$videodata['id']] = $this->charts->getChart($videodata['video_metrics'],
				[
					'bar' => ['viewCount'],

					'line' => ['likeCount', 'dislikeCount'],
					'pie' => ['likeCount', 'dislikeCount'],

				]);

			$indicators[$videodata['id']] = $this->videoStats->getBasicIndicators($videodata['video_metrics']);
		}
		//dd($videos, $finals);

		//dd($videos, $finals);

		//dd($videos);
		// } catch (\Exception $e) {
		//     Session::flash('msg', ['type' => 'danger', 'text' => $e->getMessage()]);
		//     return redirect()->back();
		// }

		return view('metrics.videometrics', compact('finals', 'videos'));
	}
}
