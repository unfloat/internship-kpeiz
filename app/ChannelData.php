<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelData extends Model
{

    protected $table = 'channel_data';

    protected $fillable = [
        'id','channel_id', 'label', 'value','type'
    ];

    protected $hidden = [
        'remember_token',
    ];
    public function channel()
    {
    	return $this->belongsTo(Channel::class);
    }
}


