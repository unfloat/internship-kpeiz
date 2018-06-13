@extends('layouts.main')
@section('content')
<div class="panel panel-white">
	<div class="panel-heading clearfix">
		<h4 class="panel-title">Send us an Email</h4>
	</div>
	<div class="panel-body">
		<p>
			A user has sent a message.
			Name: {{ $contact['name'] }}
			Message: {{ $message }}
		</div>
	</div>
	@endsection