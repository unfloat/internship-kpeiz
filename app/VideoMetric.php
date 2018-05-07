<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoMetric extends Model
{
    //

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'video_metric';


     protected $fillable = [
        'id', 'video_id', 'label', 'value','date'
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
    	$this->belongsTo(Video::class);
    }
}
