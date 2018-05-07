<?php
namespace App\Youtube;

use App\Playlist;
use App\PlaylistData;
use App\PlaylistMetric;
use Carbon\Carbon;

class YoutubePlaylistDAO
{

    public function __construct()
    {
        //
    }

    public static function savePlaylists($data, $channelID)
    {
        foreach ($data->items as $playlist) {
            //dd($playlist);
            self::savePlaylist($playlist, $channelID);
        }
    }

    public static function savePlaylist($data, $channelID)
    {
        //dd($data);

        $playlistArray = self::convertToPlaylist($data, $channelID);

        Playlist::firstOrCreate(['id' => $playlistArray['id']], $playlistArray);

        //dd($playlistArray);
        $playlistid = $playlistArray['id'];

        $playlistData = self::convertToPlaylistData($data, $playlistid);

        $playlistData->each(function ($data) {
            //dd($playlistArray);
            PlaylistData::firstOrCreate(['label' => $data['label'], 'playlist_id' => $data['playlist_id']], $data);
        });

        $playlistMetric = self::convertToPlaylistMetric($data, $playlistid);

        $playlistMetric->each(function ($metric) {
            PlaylistMetric::firstOrCreate(
                [
                    // 'label' => $metric['label'],
                    'playlist_id' => $metric['playlist_id'],
                    'date'        => $metric['date'],
                    //Retrieve metric by 'date' and 'playlist_id, or create it if it doesn't exist...
                ],
                $metric);
        });

        YoutubeVideoDAO::getVideoID($playlistid);
    }

    public static function convertToPlaylist($data, $channelID)
    {
        //dd($data);

        $playlist = [];

        $playlist['id']         = $data->id;
        $playlist['title']      = $data->snippet->title;
        $playlist['channel_id'] = $channelID;
        //$playlist['type'] = ($type == 'playlistid') ? 1 : 0;
        $playlist['description']  = $data->snippet->description;
        $playlist['published_at'] = Carbon::parse($data->snippet->publishedAt)->toDateString();

        return $playlist;
    }

    public static function convertToPlaylistData($data, $playlistid)
    {
        //dd($data);

        $thumbnail['label'] = 'thumbnail';
        $thumbnail['value'] = $data->snippet->thumbnails->default->url;
        $thumbnail['type']  = 'string';
        //$thumbnail['channel_id'] = $channelId;
        $thumbnail['playlist_id'] = $playlistid;

        $published_at['label']       = 'published_at';
        $published_at['value']       = $data->snippet->publishedAt;
        $published_at['type']        = 'date';
        $published_at['playlist_id'] = $playlistid;

        // $privacy_status['label'] = 'privacy_status';
        // $privacy_status['value'] = $data->status->privacyStatus;
        // $privacy_status['type'] = 'date';
        //$privacy_status['channel_id'] = $channelId;

        // if(isset($data->snippet->country))
        // {
        //     $country['label'] = 'country';
        //     $country['value'] = $data->snippet->country;
        //     $country['type'] = 'string';
        //     $country['channel_id'] = $channelId;

        //     return collect(compact('country','thumbnail','published_at'));
        // }
        //return collect(compact('thumbnail','published_at','privacy_status'));
        return collect(compact('thumbnail', 'published_at'));
    }

    public static function convertToPlaylistMetric($data, $playlistid)
    {

        $temp['label'] = 'item_count';
        $temp['value'] = $data->contentDetails->itemCount;
        $temp['type']  = 'int';
        //$temp['channel_id'] = $channelId;
        $temp['playlist_id'] = $playlistid;
        $temp['date']        = Carbon::now()->toDateString();

//        $dataMetrics[] = $temp;

        return collect(compact('temp'));
    }
}
