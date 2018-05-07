<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaylistData extends Model
{
    //
    protected $table = 'playlist_data';

    protected $fillable = [
        'id', 'playlist_id', 'label', 'value','type','date'
    ];


    
    public function playlist()
    {
    	return $this->belongsTo(Playlist::class);
    }
}
