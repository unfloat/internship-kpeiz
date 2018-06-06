<?php

namespace App\Providers;

use App\Channel;
use App\Playlist;
use App\User;
use App\Video;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Session;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//

		Schema::defaultStringLength(191);

		view()->composer(['metrics.channelmetrics', 'metrics.videometrics', 'playlists', 'videos', 'report'], function ($view) {

			// $savedChannels = Channel::where('user_id', Auth::user()->id);
			$savedChannels = Auth::user()->channels()->get()->toArray();

			//...with this variable
			$view->with('savedChannels', $savedChannels);
		});

	}

/**
 * Register any application services.
 *
 * @return void
 */
	public function register() {
		$this->app->singleton('since', function ($app) {
			if (!Session::has('since')) {
				return Carbon::now()->subMonths(1);
			}
			return Carbon::parse(Session::get('since'));
		});

		$this->app->singleton('until', function ($app) {
			if (!Session::has('until')) {
				return Carbon::now();
			}
			return Carbon::parse(Session::get('until'));
		});

		$this->app->singleton('channel', function ($app) {

			if (!Session::has('channel_id') && Auth::user()->channels()->count()) {

				return Auth::user()->channels()->first();
			} elseif (!Session::has('channel_id')) {
				return Channel::where('user_id', Auth::user()->id)->first();
			}

			return Channel::find(Session::get('channel_id'));
		});

		$this->app->singleton('savedVideos', function ($app) {

			if (!Session::has('savedVideos')) {

				$data = app('playlist')->load(
					['videos']
				)->toArray();
				foreach ($data['videos'] as $key => $videodata) {
					$savedVideos[$videodata['id']] = $videodata['title'];
				}
				return $savedVideos;
			}
		});

		$this->app->singleton('savedPlaylists', function ($app) {

			$data = app('channel')->load(
				['playlists']
			)->toArray();

			if ($data == []) {
				$data = app('channel')->load(
					['uploads']
				)->toArray();

				foreach ($data['playlists'] as $key => $playlistdata) {
					$savedPlaylists[$playlistdata['id']] = $playlistdata['title'];
				}
				return $savedPlaylists;

			}

			foreach ($data['playlists'] as $key => $playlistdata) {
				$savedPlaylists[$playlistdata['id']] = $playlistdata['title'];
			}

			return $savedPlaylists;

		});

		$this->app->singleton('video', function ($app) {

			$playlistID = Playlist::where('channel_id', Session::get('channel_id'))->get()->first();

			if (!Session::has('video_id')) {

				return Video::where('playlist_id', $playlistID)->get()->first();
			}

			return Video::find(Session::get('video_id'));
		});

		$this->app->singleton('playlist', function ($app) {

			if (!Session::has('playlist_id')) {
				return Playlist::where('channel_id', app('channel')->id)->first();
			}

			return Playlist::find(Session::get('playlist_id'));
		});
	}
};
