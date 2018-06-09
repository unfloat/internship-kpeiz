<?php

namespace App\Http\Controllers;

use App\Helpers\VideoStats;
use Session;

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
				'playlists',

			]
			)->toArray();
/*
$subscribersCount = $playlistsdata['metrics']['subscriberCount'];

foreach ($playlistsdata['videos'] as $key => $data) {

$rank = $this->videoStats->getRank($data['metrics'], $subscribersCount);

$playlistsdata['videos'][$key]['rank'] = $rank;
}
 */
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