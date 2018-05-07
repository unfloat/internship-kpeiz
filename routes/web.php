<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'HomeController@index');

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('google', 'LoginController@redirectToProvider')->name('login');
    Route::get('google/callback', 'LoginController@handleProviderCallback')->name('register');
    Route::get('logout', 'LoginController@logout');
});

Route::middleware(['auth'])->group(function () {

    //GET METHODS
    Route::get('/home', 'HomeController@getURL')->name('home');
    Route::get('/channelmetrics', 'IndicatersController@getMetrics')->name('channelmetrics');
    Route::get('/useractivities', 'UserActivitiesController@getMetrics')->name('useractivities');
    Route::get('/channelactivities', 'ChannelActivitiesController@getMetrics')->name('channelactivities');
    Route::get('/testchart', 'IndicatersController@ayfct')->name('testchart');

    // POST METHODS

    Route::post('/setaccount', 'formController@setAccount')->name('setAccount');
    Route::post('/channel', 'HomeController@postChannel')->name('channelSave');
    Route::post('/home', 'formController@updateDate')->name('home');
    Route::post('/putPeriod', 'formController@putPeriod')->name('putPeriod');
});
