<?php
namespace App\Mail;

use App\Mail\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable {
	use Queueable, SerializesModels;

	public $mail;
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($mail) {
		$this->mail = $mail;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this
			->to(config('mail'))
			->subject('User Contact');

	}
}