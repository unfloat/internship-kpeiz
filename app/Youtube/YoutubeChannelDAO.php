<?php

namespace App\Youtube;

use App\Channel;
use App\ChannelData;
use App\ChannelMetric;
use App\Youtube\YoutubePlaylistDAO;
use Carbon\Carbon;

class YoutubeChannelDAO {

	public function __construct() {
		//
	}

	public static function saveChannels($data, $user_id) {

		foreach ($data as $key => $channel) {
			self::saveChannel($channel, $user_id);
		}
	}

	public static function saveChannel($data, $user_id) {

		if (count($data->items) == 0) {
			dd('no items');
		}

		$channelArray = self::convertToChannel(head($data->items), $user_id);

		Channel::firstOrCreate(
			['id' => $channelArray['id']],
			$channelArray);

		$channelData = self::convertToChannelData(head($data->items), $channelArray['id']);

		$channelData->each(function ($data) {
			ChannelData::firstOrCreate(['label' => $data['label'], 'channel_id' => $data['channel_id']], $data);
		});

		$channelMetric = self::convertToChannelMetric(head($data->items), $channelArray['id']);

		$channelMetric->each(function ($metric) {
			ChannelMetric::firstOrCreate(
				[
					'label' => $metric['label'],
					'channel_id' => $metric['channel_id'],
					'date' => $metric['date'],
					//Retrieve metric by 'date' and 'channel_id, or create it if it doesn't exist...
				],
				$metric);
		});

		$savedId = $channelArray['id'];

		$playlistdata = YoutubeAdapter::getPlaylistByChannelId($savedId);

		YoutubePlaylistDAO::savePlaylists($playlistdata, $savedId, $channelArray['title']);

		if (isset($channelArray['uploads'])) {
			$uploadedVideos = YoutubeAdapter::getVideosByPlaylistId($channelArray['uploads']);

			foreach ($uploadedVideos->items as $uploadedVideo) {
				$id = $uploadedVideo->contentDetails->videoId;
				$data = YoutubeAdapter::getVideobyVideoId($id);

				YoutubeVideoDAO::saveVideos($data, $channelArray['uploads'], $channelArray['title']);
			}
		}

		return true;

	}

	public static function convertToChannel($data, $user_id) {

		$channel = [];

		$channel['id'] = $data->id;
		$channel['title'] = $data->snippet->title;
		$channel['user_id'] = $user_id;
		$channel['description'] = $data->snippet->description;
		$channel['published_at'] = Carbon::parse($data->snippet->publishedAt);
		$channel['uploads'] = $data->contentDetails->relatedPlaylists->uploads;

		return $channel;
	}

	public static function convertToChannelData($data, $channelId) {

		$thumbnail['label'] = 'thumbnail';
		$thumbnail['value'] = $data->snippet->thumbnails->default->url;
		$thumbnail['type'] = 'string';
		$thumbnail['channel_id'] = $channelId;

		$subCount['label'] = 'hiddenSubscriberCount';
		$subCount['value'] = $data->statistics->hiddenSubscriberCount;
		$subCount['type'] = 'boolean';
		$subCount['channel_id'] = $channelId;

		if (isset($data->snippet->country)) {
			$country['label'] = 'country';
			$country['value'] = $data->snippet->country;
			$country['type'] = 'string';
			$country['channel_id'] = $channelId;

			return collect(compact('country', 'thumbnail', 'subCount'));
		}
		return collect(compact('thumbnail', 'subCount'));
	}

	public static function convertToChannelMetric($data, $channelId) {
		$dataMetrics = [];
		foreach ($data->statistics as $key => $element) {
			if ('hiddenSubscriberCount' == $key) {
				continue;
			}

			$temp['label'] = $key;
			$temp['value'] = $element;
			$temp['type'] = 'int';
			$temp['channel_id'] = $channelId;
			$temp['date'] = Carbon::now();

			$dataMetrics[] = $temp;
		}

		return collect($dataMetrics);
	}
}
