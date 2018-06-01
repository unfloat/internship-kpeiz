<?php

namespace App\Http\Controllers;

use App\Helpers\ActiveMetrics;
use App\Helpers\CreateChart;
use App\Helpers\PlaylistStats;
use Session;

class PlaylistController extends Controller {
	//
	protected $charts;
	protected $playlistStats;
	protected $activePlaylist;

	public function __construct(CreateChart $charts, PlaylistStats $playlistStats, ActiveMetrics $activePlaylist) {
		$this->charts = $charts;
		$this->playlistStats = $playlistStats;
		$this->activePlaylist = $activePlaylist;
	}
	public function getPlaylists() {
		$since = app('since');
		$until = app('until');

		$playlistsdata = app('channel')->load([
			'playlists' => function ($query) use ($since, $until) {
				$query->whereBetween('playlists.created_at', [$since, $until]);},

		]
		)->toArray();

		return view('playlists', compact('playlistsdata'));
	}

	public function getMetrics($id) {

		$since = app('since');
		$until = app('until');
		$savedPlaylists = app('savedPlaylists');

		Session::put('playlist_id', $id);
		Session::save();

		try {

			//dd($since, $until);
			$playlistsdata = app('channel')->load([
				'playlists' => function ($query) use ($since, $until, $id) {
					$query->where('playlists.id', $id)->whereBetween('playlists.created_at', [$since, $until]);},

			]
			)->toArray();

/*		$playlistsData = $this->activePlaylist->getActive('playlist', $since, $until);

 */

		} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data ']);
			//dd(app('since'), app('until'));
		}

		return view('metrics.playlistmetrics', compact('playlistsdata', 'savedPlaylists'));
	}
}

/*/

}

}
}