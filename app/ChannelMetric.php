<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelMetric extends Model
{
    //
    protected $table = 'channel_metric' ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'channel_id', 'label','value','date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '',
    ];

    public function channels()
    {
    	return $this->belongTo(Channel::class);
    }
}
