<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistMetric extends Model
{
    //
    protected $table = 'playlist_metric';

    protected $fillable = [
        'id', 'playlist_id', 'label', 'value','type','date'
    ];

    public function playlist()
    {
    	return $this->belongsTo(Playlist::class);
    }
}
