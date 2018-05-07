<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoData extends Model
{
    //
    

    protected $table = 'video_data';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'video_id', 'label', 'value','type'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
    public function video()
    {
    	return $this->belongsTo(Video::class);
    }
}

