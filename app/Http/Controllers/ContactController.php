<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {

	public function send() {
		Mail::send(new Contact());
	}

	public function mail() {
		return view('contact');
	}
}