<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Auth;
use Illuminate\Support\Facades\Mail;
use Session;

class ContactController extends Controller {

	public function mail() {
		return view('contact');
	}

	public function sendmail(ContactFormRequest $request) {
		$contact = [];

		$contact['name'] = $request->get('name');
		$contact['email'] = Auth::user()->email;
		$contact['message'] = $request->get('message');

		Mail::send('mailtemplate', ['message' => $contact['message'], function ($mail) use ($contact) {
			$mail->from($contact['email'], $contact['name']);
			$mail->to('olphazarrouk@gmail.com')->subject('User Contact');
		},
		]);

		Session::flash('msg', ['type' => 'success', 'text' => 'Your message has been sent!']);

		return redirect()->back();

	}

}