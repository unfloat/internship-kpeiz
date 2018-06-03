<?php
namespace App\Youtube;

use App\Playlist;
use App\PlaylistData;
use App\PlaylistMetric;
use Carbon\Carbon;

class YoutubePlaylistDAO {

	public function __construct() {
		//
	}

	public static function savePlaylists($data, $channelID, $channelTitle) {
		foreach ($data->items as $playlist) {

			self::savePlaylist($playlist, $channelID, $channelTitle);
		}
	}

	public static function savePlaylist($data, $channelID, $channelTitle) {

		$playlistArray = self::convertToPlaylist($data, $channelID, $channelTitle);

		Playlist::firstOrCreate(['id' => $playlistArray['id']], $playlistArray);

		$playlistid = $playlistArray['id'];

		$playlistData = self::convertToPlaylistData($data, $playlistid);

		$playlistData->each(function ($data) {

			PlaylistData::firstOrCreate(['label' => $data['label'], 'playlist_id' => $data['playlist_id']], $data);
		});

		$playlistMetric = self::convertToPlaylistMetric($data, $playlistid);

		$playlistMetric->each(function ($metric) {
			PlaylistMetric::firstOrCreate(
				[

					'playlist_id' => $metric['playlist_id'],
					'date' => $metric['date'],

				],
				$metric);
		});

		YoutubeVideoDAO::getVideoID($playlistid, $channelTitle);
	}

	public static function convertToPlaylist($data, $channelID, $channelTitle) {

		$playlist = [];

		$playlist['id'] = $data->id;
		$playlist['title'] = $data->snippet->title;
		$playlist['channel_id'] = $channelID;
		$playlist['channel_title'] = $channelTitle;
		$playlist['description'] = $data->snippet->description;
		$playlist['published_at'] = Carbon::parse($data->snippet->publishedAt);

		return $playlist;
	}

	public static function convertToPlaylistData($data, $playlistid) {

		$thumbnail['label'] = 'thumbnail';
		$thumbnail['value'] = $data->snippet->thumbnails->default->url;
		$thumbnail['type'] = 'string';
		$thumbnail['playlist_id'] = $playlistid;

		$published_at['label'] = 'published_at';
		$published_at['value'] = $data->snippet->publishedAt;
		$published_at['type'] = 'date';
		$published_at['playlist_id'] = $playlistid;

		return collect(compact('thumbnail', 'published_at'));
	}

	public static function convertToPlaylistMetric($data, $playlistid) {

		$temp['label'] = 'item_count';
		$temp['value'] = $data->contentDetails->itemCount;
		$temp['type'] = 'int';
		$temp['playlist_id'] = $playlistid;
		$temp['date'] = Carbon::now();

		return collect(compact('temp'));
	}
}
