<?php

namespace App\Http\Controllers;

class ContactController extends Controller {
	//
	public function getContact() {
		return view('contact');
	}

	public function sendMessage() {
		return view('contact');
	}

}
