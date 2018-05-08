<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    //

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'channel_id', 'title', 'description', 'published_at', 'channel_title',
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

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function playlistMetric()
    {
        return $this->hasMany(PlaylistMetric::class);
    }

    public function playlistData()
    {
        return $this->hasMany(PlaylistData::class);
    }

    public function getMetricsAttribute()
    {
        if (is_null($this->playlistMetric)) {
            $this->load('playlistMetric');
        }
        return $this->playlistMetric->pluck('value', 'label');
    }

    public function getDataAttribute()
    {
        if (is_null($this->playlistData)) {
            $this->load('playlistData');
        }
        return $this->playlistData->pluck('value', 'label');
    }
}
