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

	public function getMetrics() {

		$since = app('since');
		$until = app('until');

		/*dd(app('playlist'));*/

		/*	try {*/

		/*if (Session::get('playlist')) {
			$playlistsData = $this->activePlaylist->getActive('playlist', $since, $until);

		} else {*/
		$playlistsData = app('channel')->load([
			'playlists' => function ($query) use ($since, $until) {
				$query->whereBetween('playlists.created_at', [$since, $until]);},

		]
		)->toArray();

		foreach ($playlistsData['playlists'] as $key => $value) {
			//dd($value['playlist_data']);

			$playlists[$value['id']] = $value['title'];

			//$bestPlaylistVideos[] = Video::with(['videoMetrics'])->where(function ($query) use ($since, $until) {
			/*
				$query->orderBy('videoMetrics', 'asc');
			})->where('playlist_id', $value['id'])->take(3)->get()->toArray();*/

			/*$indicators[$value['id']] = $this->playlistStats->getBasicIndicators($value['playlist_metric']);*/
			$infos[$value['id']] = $this->playlistStats->getBasicInfo($value['playlist_data']);

		}

		/*} catch (\Exception $e) {
				Session::flash('msg', ['type' => 'danger', 'text' => 'No collected Data ']);
				//dd(app('since'), app('until'));
			}
		*/
		//dd($playlistsData, $since, $until);

		return view('metrics.playlistmetrics', compact('infos', 'playlists'));
	}

}
