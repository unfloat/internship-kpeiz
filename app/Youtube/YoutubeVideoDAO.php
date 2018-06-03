<?php
namespace App\Youtube;

use App\Video;
use App\VideoData;
use App\VideoMetric;
use App\Youtube\YoutubeAdapter;
use Carbon\Carbon;

class YoutubeVideoDAO {

	public function __construct() {
		//
	}

	public static function getVideoID($playlistid, $channelTitle) {

		$playlistItemsResponse = YoutubeAdapter::getVideosByPlaylistId($playlistid);

		foreach ($playlistItemsResponse->items as $playlistItem) {
			$videoid = $playlistItem->contentDetails->videoId;

			self::saveVideos(YoutubeAdapter::getVideobyVideoId($videoid), $playlistid, $channelTitle);
		}
	}

	public static function saveVideos($data, $playlistid, $channelTitle) {

		foreach ($data->items as $key => $video) {

			self::saveVideo($video, $playlistid, $channelTitle);
		}
	}

	public static function saveVideo($data, $playlistid, $channelTitle) {

		$videoArray = self::convertToVideo($data, $playlistid, $channelTitle);
		$videoid = $videoArray['id'];

		Video::firstOrCreate(['id' => $videoid], $videoArray);

		$videoData = self::convertToVideoData($data, $videoid);

		$videoData->each(function ($data) {

			VideoData::firstOrCreate(['label' => $data['label'], 'video_id' => $data['video_id']], $data);
		});

		$videoMetric = self::convertToVideoMetric($data, $videoid);

		$videoMetric->each(function ($metric) {
			VideoMetric::firstOrCreate(
				[
					'video_id' => $metric['video_id'],
					'date' => $metric['date'],
					'label' => $metric['label'],
				],
				$metric);
		});
	}

	public static function convertToVideo($data, $playlistid, $channelTitle) {

		$video['id'] = $data->id;
		$video['title'] = $data->snippet->title;
		$video['playlist_id'] = $playlistid;
		$video['channel_title'] = $channelTitle;
		$video['description'] = $data->snippet->description;
		$video['published_at'] = Carbon::parse($data->snippet->publishedAt);

		return $video;
	}

	public static function convertToVideoData($videodata, $videoid) {

		$thumbnail['label'] = 'thumbnail';
		$thumbnail['value'] = $videodata->snippet->thumbnails->default->url;
		$thumbnail['type'] = 'string';
		$thumbnail['video_id'] = $videoid;

		$published_at['label'] = 'published_at';
		$published_at['value'] = $videodata->snippet->publishedAt;
		$published_at['type'] = 'date';
		$published_at['video_id'] = $videoid;

		if (isset($videodata->snippet->tags)) {
			foreach ($videodata->snippet->tags as $tag) {
				$tags['label'] = 'tags';
				$tags['value'] = $tag;
				$tags['type'] = 'string';
				$tags['video_id'] = $videoid;
			}
		}

		if (isset($videodata->snippet->country)) {
			$country['label'] = 'country';
			$country['value'] = $videodata->snippet->country;
			$country['type'] = 'string';
			$country['video_id'] = $videoid;

			return collect(compact('country', 'thumbnail', 'published_at', 'tags'));
		}
		return collect(compact('thumbnail', 'published_at', 'tags'));
	}

	public static function convertToVideoMetric($videodata, $videoid) {

		$dataMetrics = [];

		foreach ($videodata->statistics as $key => $element) {
			if ('favoriteCount' == $key) {
				continue;
			}

			$temp['label'] = $key;
			$temp['value'] = $element;
			$temp['type'] = 'int';
			$temp['video_id'] = $videoid;
			$temp['date'] = Carbon::now();

			$dataMetrics[] = $temp;
		}

		return collect($dataMetrics);
	}
}
