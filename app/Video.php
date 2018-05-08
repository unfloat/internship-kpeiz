<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'playlist_id', 'title', 'description', 'published_at', 'channel_title',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $appends = [
        'metrics', 'data',
    ];

    public function playlists()
    {
        return $this->belongsTo(Playlist::class);
    }

    public function videoMetrics()
    {
        return $this->hasMany(VideoMetric::class);
    }

    public function videoData()
    {
        return $this->hasMany(VideoData::class);
    }

    public function getMetricsAttribute()
    {
        if (is_null($this->videoMetrics)) {
            $this->load('videoMetrics');
        }
        return $this->videoMetrics->pluck('value', 'label');
    }

    public function getDataAttribute()
    {
        if (is_null($this->videoData)) {
            $this->load('videoData');
        }
        return $this->videoData->pluck('value', 'label');
    }
}
