<?php

namespace App\Youtube;

class UrlAdapter {

	public static function parseVideoFromURL($youtube_url) {
		if (strpos($youtube_url, 'youtube.com')) {
			if (strpos($youtube_url, 'embed')) {
				$path = static::_parse_url_path($youtube_url);
				$vid = substr($path, 7);
				//dd('youtube.com');
				return $vid;
			} else {
				$params = static::_parse_url_query($youtube_url);
				return $params['v'];
			}
		} else if (strpos($youtube_url, 'youtu.be')) {
			$path = static::_parse_url_path($youtube_url);
			$vid = substr($path, 1);
			return $vid;
		} else {
			throw new \Exception('The supplied URL does not look like a Youtube Video URL');
		}
		//dd($vid);
	}

	public static function parseChannelFromURL($youtube_url) {
		if (strpos($youtube_url, 'youtube.com') === false) {
			throw new \Exception('The supplied URL does not look like a Youtube URL ');
		}

		$path = static::_parse_url_path($youtube_url);
		if (strpos($path, '/channel') === 0) {
			$segments = explode('/', $path);
			$type = 'channel';
			$channel = $segments[count($segments) - 1];

		} else if (strpos($path, '/user') === 0) {
			$segments = explode('/', $path);
			$username = $segments[count($segments) - 1];
			$type = 'user';

			$channel = $username;
		} else {
			throw new \Exception('The supplied URL does not look like a Youtube Channel URL');
		}

		return compact('channel', 'type');
	}

	public static function parsePlaylistFromURL($youtube_url) {
		if (strpos($youtube_url, 'youtube.com') === false) {
			throw new \Exception('The supplied URL does not look like a Youtube URL');
			//testing if valid youtube url
		}
		$path = static::_parse_url_path($youtube_url);
		//retrieve complete url
		//dd($path);
		$listpath = parse_url($youtube_url, PHP_URL_QUERY);
		//retrieve playlist url
		//dd($listpath);

		if (strpos($listpath, 'list') === 0) {
			$segments = explode('=', $listpath);
			//retrieve playlist id
			//dd($segments);
			$type = 'playlist';
			//indicate url type (playlist)
			$playlistID = $segments[count($segments) - 1];
			//dd($playlistID);
		} else if ((strpos($path, '/channel') === 0) || (strpos($path, '/user') === 0)) {
			//if the user indicates a non playlist url
			$playlistData = self::parseChannelFromURL($youtube_url);
			$playlistID = $playlistData['channel'];
			$type = $playlistData['type'];
			//indicate url type (channel || user)
		} else {
			throw new \Exception('The supplied URL does not look like a Youtube Playlist URL');
		}

		return compact('playlistID', 'type');
	}

	public static function _parse_url_query($url) {
		$array = parse_url($url);
		$query = $array['query'];

		$queryParts = explode('&', $query);

		$params = [];
		foreach ($queryParts as $param) {
			$item = explode('=', $param);
			$params[$item[0]] = empty($item[1]) ? '' : $item[1];
		}

		return $params;
	}

	public static function _parse_url_path($url) {
		$array = parse_url($url);

		return $array['path'];
	}

	// GETTING VIDEO OR CHANNEL ID FROM USER URL

	/**
	 * Get the channel object by supplying the URL of the channel page
	 *
	 * @param  string $youtube_url
	 * @throws \Exception
	 * @return object Channel object
	 */
}
