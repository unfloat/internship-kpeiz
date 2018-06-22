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
Route::get('login', 'Auth\LoginController@index');

Route::prefix('auth')->namespace('Auth')->group(function () {
	Route::get('google', 'LoginController@redirectToProvider')->name('login');
	Route::get('google/callback', 'LoginController@handleProviderCallback')->name('register');

});

Route::middleware(['auth'])->group(function () {

	Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	//GET METHODS
	Route::get('/home', 'HomeController@getURL')->name('home');
	Route::get('/videos/{id?}', 'VideoController@getVideos')->name('videos');
	Route::get('/playlists', 'PlaylistController@getPlaylists')->name('playlists');
	Route::get('/channelmetrics/{id?}', 'ChannelController@getMetrics')->name('channelmetrics');
	Route::get('/videometrics/{id?}', 'VideoController@getMetrics')->name('videometrics');
	Route::get('/playlistmetrics/{id}', 'PlaylistController@getMetrics')->name('playlistmetrics');
	Route::get('/channelreports', 'ReportController@getReport')->name('channelreports');
	Route::get('/downloadPDF', 'ReportController@downloadPDF')->name('downloadPDF');
	Route::get('/downloadPDFVideo', 'ReportController@downloadPDFVideo')->name('downloadPDFVideo');

	Route::get('/mail', 'ContactController@mail')->name('mail');

	// POST METHODS

	Route::post('/setaccount', 'formController@setAccount')->name('setAccount');
	Route::post('/setplaylist', 'formController@setPlaylist')->name('setPlaylist');

	Route::post('/channel', 'HomeController@postChannel')->name('channelSave'); //here
	Route::post('/datepick', 'formController@updateDate')->name('datePick');
	Route::post('/setvideo', 'formController@setVideo')->name('setVideo');

	Route::post('/sendmail', 'ContactController@sendmail')->name('sendmail');

});
