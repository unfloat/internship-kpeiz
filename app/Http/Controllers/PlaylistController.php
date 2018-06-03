<?php

namespace App\Http\Controllers;

use App\Helpers\VideoStats;

class PlaylistController extends Controller {
	//

	protected $videoStats;

	public function __construct(VideoStats $videoStats) {

		$this->videoStats = $videoStats;

	}
	public function getPlaylists() {
		$since = app('since');
		$until = app('until');

		try {

			$playlistsdata = app('channel')->load([
				'playlists' => function ($query) use ($since, $until) {
					$query->whereBetween('playlists.created_at', [$since, $until]);},
				'videos' => function ($query) use ($since, $until) {
					$query->whereBetween('videos.created_at', [$since, $until]);},

			]
			)->toArray();

			$subscribersCount = $playlistsdata['metrics']['subscriberCount'];

			foreach ($playlistsdata['videos'] as $key => $data) {

				$rank = $this->videoStats->getRank($data['metrics'], $subscribersCount);

				$playlistsdata['videos'][$key]['rank'] = $rank;
			}

		} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => $e->getMessage()]);
			return redirect()->back();
		}

		return view('playlists', compact('playlistsdata'));
	}

}

/*/

}

}
}