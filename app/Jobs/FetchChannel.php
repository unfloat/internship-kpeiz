<?php

namespace App\Jobs;

use App\User;
use App\Youtube\YoutubeChannelDAO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchChannel implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $data;
	protected $user;
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($data, User $user) {
		$this->data = $data;
		$this->user = $user;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {

		YoutubeChannelDAO::saveChannel($this->data, $this->user->id);

	}
}
