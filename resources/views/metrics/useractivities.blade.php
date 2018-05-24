@extends('layouts.main')

@section('css')

@endsection

@section('content')

<div class="row">




@if(isset($finals))
	@foreach($finals as $key => $final )
	{{ 'Video : '.$key }}
	@foreach ($final as $key => $charts)
	@foreach ($charts as $key => $chart)
	{{$chart->title}}
	<div class="card-body">
		<canvas id="{{ $chart->id }}" width="100%" height="30"></canvas>
	</div>
	@endforeach
	@endforeach
	@endforeach
	@endif





</div>



@endsection




@section('js')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script> --}}

@if(isset($finals))

@foreach($finals as $key => $final )
@foreach ($final as $key => $charts)
@foreach ($charts as $key => $chart)

@include('charts.'.$chart->type,['chart' => $chart])

@endforeach
@endforeach
@endforeach
@endif

@endsection
