<?php

namespace App\Youtube;

use App\Youtube\Api;

class YoutubeAdapter
{
    public static function getUserChannel($channelName)
    {
        $data['part'] = 'snippet,contentDetails,statistics';
        //$data['maxResults'] = $maxresults;

        $data['forUsername'] = $channelName;

        return Api::get('channels', $data);
    }

    public static function getChannelbyChannelId($id)
    {

        $data['part'] = 'statistics,snippet,contentDetails';
        $data['id']   = $id;

        return Api::get('channels', $data);
    }

    public static function getPlaylistByChannelId($channelId)
    {
        $data['part']       = 'snippet,contentDetails';
        $data['maxResults'] = '50';
        $data['channelId']  = $channelId;
        //dd($data);

        return Api::get('playlists', $data);
    }

    public static function getVideosByPlaylistId($playlistId)
    {
        //

        $data['part']       = 'snippet,contentDetails';
        $data['maxResults'] = '50';
        $data['playlistId'] = $playlistId;

        return Api::get('playlistItems', $data);
    }

    public static function getChannelActivities($channelId)
    {
        $data['part']       = 'snippet,contentDetails';
        $data['maxResults'] = '50';
        $data['channelId']  = $channelId;

        // $data['publishedAfter'] = $channelId;
        // $data['publishedBefore'] = $channelId;

        return Api::get('channels', $data);
    }

// public static function getCommentResponsesByCommentId($commentId)
    // {
    //     $data['part'] = 'snippet';

//     $data['parentId'] = $commentId;

//     return Api::get('comments', $data);
    // }

// public static function getVideoComments($videoId, $pageToken = null)
    // {

//     $data['part'] = 'snippet';
    //     $data['textFormat'] = 'plainText';
    //     $data['videoId'] = $videoId;

//     if (!is_null($pageToken)) {
    //         $data['pageToken'] = $pageToken;
    //     }
    //     return Api::get('commentThreads', $data);
    // }

    public static function getVideobyVideoId($videoId)
    {

        $data['part']       = 'statistics,snippet,contentDetails';
        $data['maxResults'] = '50';

        $data['id'] = $videoId;

        return Api::get('videos', $data);
    }

// public static function getAllcomments($nextPage = null)
    // {
    //     $response = self::getVideoComments('OJBXKMy5smI', $nextPage);

//     $videoComments = collect($response->items);

// }
}
