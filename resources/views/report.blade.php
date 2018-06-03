@extends('layouts.main')
@section('content')

<div class="row">
	<button class="btn btn-primary">
	<a href="{{ route('downloadPDF',['download'=>'pdf']) }}">Download PDF</a>
	</button>
</div>


@endsection