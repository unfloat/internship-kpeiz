<?php

namespace App\Providers;

use App\Channel;
use App\Playlist;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        view()->composer(['*'], function ($view) {

            // $savedChannels = Channel::where('user_id', Auth::user()->id);
            $savedChannels = Auth::user()->channels()->get()->toArray();

            //...with this variable
            $view->with('savedChannels', $savedChannels);
        });
        view()->composer(['*'], function ($view) {
            $since        = app('since');
            $until        = app('until');
            $playlistdata = app('channel')->load(
                ([
                    'playlists' => function ($query) use ($since, $until) {
                        $query->whereBetween('playlists.created_at', [$since, $until]);},

                ])
            )->toArray();

            $playlistdata = app('channel')->load(
                ([
                    'playlists' => function ($query) {
                        $query->whereBetween('playlists.created_at', [app('since'), app('until')]);},

                ])
            )->toArray();

            //dd($playlistdata, app('since'), app('until'));

            foreach ($playlistdata as $key => $value) {
                $savedPlaylists[$value['id']] = $value['title'];
            }

            // dd($savedPlaylists);

            $view->with('savedPlaylists', $savedPlaylists);
        });
    }

/**
 * Register any application services.
 *
 * @return void
 */
    public function register()
    {
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

        $this->app->singleton('playlist', function ($app) {

            if (!Session::has('playlist_id') && Auth::user()->channels()->playlists()->count()) {
                return Playlist::where('channel_id', app('channel')->id)->first();;
            } elseif (!Session::has('playlist_id')) {
                return Playlist::where('channel_id', app('channel')->id)->first();
            }

            return Playlist::find(Session::get('playlist_id'));
        });
    }
};
