<?php
namespace App\Youtube;

use App\Video;
use App\VideoData;
use App\VideoMetric;
use App\Youtube\YoutubeAdapter;
use Carbon\Carbon;

class YoutubeVideoDAO
{

    public function __construct()
    {
        //
    }

    //$videodata = YoutubeAdapter::getVideosByPlaylistId($playlistid);

    public static function getVideoID($playlistid, $channelTitle)
    {

        //self::saveVideos(YoutubeAdapter::getVideosByPlaylistId('UUfz-e1mfFE85VWicAfipduw'), $playlistid);
        $playlistItemsResponse = YoutubeAdapter::getVideosByPlaylistId($playlistid);
        //dd($playlistItemsResponse->items);
        foreach ($playlistItemsResponse->items as $playlistItem) {
            $videoid = $playlistItem->contentDetails->videoId;
            //dd($videoid);
            // $test = YoutubeAdapter::getVideobyVideoId($videoid);
            // dd($test);

            self::saveVideos(YoutubeAdapter::getVideobyVideoId($videoid), $playlistid, $channelTitle);
        }
    }

    public static function saveVideos($data, $playlistid, $channelTitle)
    {

        foreach ($data->items as $video) {
            //dd($video);
            self::saveVideo($video, $playlistid, $channelTitle);
        }
    }

    public static function saveVideo($data, $playlistid, $channelTitle)
    {

        $videoArray = self::convertToVideo($data, $playlistid, $channelTitle);
        $videoid    = $videoArray['id'];

        Video::firstOrCreate(['id' => $videoid], $videoArray);

        //dd($data->id);

        //dd($videoArray);

        $videoData = self::convertToVideoData($data, $videoid);

        $videoData->each(function ($data) {

            VideoData::firstOrCreate(['label' => $data['label'], 'video_id' => $data['video_id']], $data);
        });

        $videoMetric = self::convertToVideoMetric($data, $videoid);

        $videoMetric->each(function ($metric) {
            VideoMetric::firstOrCreate(
                [
                    'video_id' => $metric['video_id'],
                    'date'     => $metric['date'],
                    'label'    => $metric['label'],
                ],
                $metric);
        });
    }

    public static function convertToVideo($data, $playlistid, $channelTitle)
    {
        //dd($data->id);

        $video['id']            = $data->id;
        $video['title']         = $data->snippet->title;
        $video['playlist_id']   = $playlistid;
        $video['channel_title'] = $channelTitle;
        //$video['type'] = ($type == 'videoid') ? 1 : 0;
        $video['description']  = $data->snippet->description;
        $video['published_at'] = Carbon::parse($data->snippet->publishedAt)->toDateString();

        // $video['id'] = $data->id;
        // $video['title'] = $data->snippet->title;
        // $video['playlist_id'] = $videoid;
        // //$video['type'] = ($type == 'videoid') ? 1 : 0;
        // $video['description'] = $data->snippet->description;
        // $video['published_at'] = Carbon::parse($data->snippet->publishedAt);

        return $video;
    }

    public static function convertToVideoData($videodata, $videoid)
    {

        $thumbnail['label'] = 'thumbnail';
        $thumbnail['value'] = $videodata->snippet->thumbnails->default->url;
        $thumbnail['type']  = 'string';
        //$thumbnail['channel_id'] = $channelId;
        $thumbnail['video_id'] = $videoid;

        $published_at['label']    = 'published_at';
        $published_at['value']    = $videodata->snippet->publishedAt;
        $published_at['type']     = 'date';
        $published_at['video_id'] = $videoid;

        // $duration['label'] = 'duration';
        // $duration['value'] = $videodata->snippet->contentDetails->duration;
        // $duration['type'] = 'date';
        // $duration['video_id'] = $videoid;

        // $privacy_status['label'] = 'privacy_status';
        // $privacy_status['value'] = $videodata->snippet->status->privacyStatus;
        // $privacy_status['type'] = 'string';
        // $privacy_status['video_id'] = $videoid;
        if (isset($videodata->snippet->tags)) {
            foreach ($videodata->snippet->tags as $tag) {
                $tags['label']    = 'tags';
                $tags['value']    = $tag;
                $tags['type']     = 'string';
                $tags['video_id'] = $videoid;
            }
        }

        if (isset($videodata->snippet->country)) {
            $country['label']    = 'country';
            $country['value']    = $videodata->snippet->country;
            $country['type']     = 'string';
            $country['video_id'] = $videoid;

            return collect(compact('country', 'thumbnail', 'published_at', 'tags'));
        }
        return collect(compact('thumbnail', 'published_at', 'tags'));
    }

    public static function convertToVideoMetric($videodata, $videoid)
    {

        $dataMetrics = [];

        foreach ($videodata->statistics as $key => $element) {
            // favoriteCount is deprecated
            if ('favoriteCount' == $key) {
                continue;
            }
            //

            $temp['label']    = $key;
            $temp['value']    = $element;
            $temp['type']     = 'int';
            $temp['video_id'] = $videoid;
            $temp['date']     = Carbon::now()->toDateString();

            $dataMetrics[] = $temp;
        }

        return collect($dataMetrics);

        //     $view_count['label'] = 'view_count';
        //     $view_count['value'] = $data->statistics->viewCount;
        //     $view_count['type'] = 'int';
        //     //$temp['channel_id'] = $channelId;
        //     $view_count['video_id'] = $videoid;
        //     $view_count['date'] = Carbon::now();

        //     $like_count['label'] = 'like_count';
        //     $like_count['value'] = $data->statistics->likeCount;
        //     $like_count['type'] = 'int';
        //     //$temp['channel_id'] = $channelId;
        //     $like_count['video_id'] = $videoid;
        //     $like_count['date'] = Carbon::now();

        //     $dislike_count['label'] = 'dislike_count';
        //     $dislike_count['value'] = $data->statistics->dislikeCount;
        //     $dislike_count['type'] = 'int';
        //     //$temp['channel_id'] = $channelId;
        //     $dislike_count['video_id'] = $videoid;
        //     $dislike_count['date'] = Carbon::now();

        //     $favorite_count['label'] = 'favorite_count';
        //     $favorite_count['value'] = $data->statistics->favoriteCount;
        //     $favorite_count['type'] = 'int';
        //     //$temp['channel_id'] = $channelId;
        //     $favorite_count['video_id'] = $videoid;
        //     $favorite_count['date'] = Carbon::now();

        //     $comment_count['label'] = 'comment_count';
        //     $comment_count['value'] = $data->statistics->commentCount;
        //     $comment_count['type'] = 'int';
        //     //$temp['channel_id'] = $channelId;
        //     $comment_count['video_id'] = $videoid;
        //     $comment_count['date'] = Carbon::now();
        // }
    }
}
