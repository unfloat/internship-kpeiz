<?php

namespace App\Http\Controllers;

use App\Helpers\ActiveMetrics;
use App\Helpers\CreateChart;
use App\Helpers\PlaylistStats;

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

	public function getMetrics() {

		//dd($since, $until);

		$playlistsData = $this->activePlaylist->getActive('playlist', $since, $until);

		foreach ($playlistsData['playlists'] as $key => $value) {
			//dd($value['data']);

			$playlists[$value['id']] = $value['title'];

			$indicators[$value['id']] = $this->playlistStats->getBasicIndicators($value['metrics']);

			$infos[$value['id']] = $this->playlistStats->getBasicInfo($value['data']);
			//$bestPlaylistVideos[] = Video::with(['videoMetrics'])->where(function ($query) use ($since, $until) {
			/*
				$query->orderBy('videoMetrics', 'asc');
			})->where('playlist_id', $value['id'])->take(3)->get()->toArray();*/

		}

		/*} catch (\Exception $e) {
			Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data ']);
			//dd(app('since'), app('until'));
		}*/

		//dd($playlists, $infos);

		return view('metrics.playlistmetrics', compact('infos', 'playlists', 'indicators'));
	}

}
