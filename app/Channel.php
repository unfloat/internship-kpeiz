<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model {
	public $incrementing = false;
//    protected $table = 'channels';
	protected $fillable = [
		'id', 'user_id', 'description', 'published_at', 'title',
	];
	protected $appends = [
		'metrics', 'data',
	];
	public function playlists() {
		return $this->hasMany(Playlist::class);
	}
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function channelMetric() {
		return $this->hasMany(ChannelMetric::class);
	}
	public function channelData() {
		return $this->hasMany(ChannelData::class);
	}
	public function videos() {
		return $this->hasManyThrough(Video::class, Playlist::class);
	}
	public function getMetricsAttribute() {
		if (is_null($this->channelMetric)) {
			$this->load('channelMetric');
		}
		return $this->channelMetric->pluck('value', 'label');
	}
	public function getDataAttribute() {
		if (is_null($this->channelData)) {
			$this->load('channelData');
		}
		return $this->channelData->pluck('value', 'label');
	}
}