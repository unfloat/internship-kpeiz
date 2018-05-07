<?php

namespace App\Providers;

use App\Channel;
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton('period', function ($app) {
        //     if (!Session::has('period')) {
        //         return //Monthly Data
        //     }
        //     return Carbon::parse(Session::get('period'));
        // });

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
                return Channel::where('title', 'PewDiePie')->first();
            }

            return Channel::find(Session::get('channel_id'));
        });
    }
}
