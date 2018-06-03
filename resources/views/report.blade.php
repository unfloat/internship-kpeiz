@extends('layouts.main')
@section('content')

<div class="row">
	<button class="btn btn-primary">
	<a href="{{ url('/downloadPDF')}}">download</a>
	</button>
</div>

@endsection