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


	@if(isset($bestPosts))
	@foreach($bestPosts as $key => $value)
	<div class="col-lg-3 col-md-3">
		<div class="thumbnail" >
			<img src={{$value['value']}} alt="...">
		</div>
	</div>
	@endforeach
	@endif
{{--
	@if(isset($bestPosts))
	@foreach($bestPosts as $key => $value)
	<div class="col-lg-3 col-md-3">
		<div class="thumbnail" >
			<img src={{$bestVideoByPlaylist['data']['thumbnail']}} alt="...">
			<div class="caption">
				<p>{{$bestVideo['title']}}</p>
				<ul class="list-unstyled">
					@foreach($bestVideoByPlaylist['metrics'] as $key => $value)
					<li>
						{{ config('chartsLabels.'.$key)}}<span>{{$value}}</span>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

	</div>
	@endforeach
	@endif

	@if(isset($bestVideoMetrics))
     @foreach($bestVideoMetrics as $metrics)
   <div class="col-xs-6 col-md-3">
     <div class="thumbnail">
      <img src={{$metrics['data']['thumbnail']}} alt="...">
      <div class="caption">
        <p>{{$metrics['title']}}</p>
        @foreach($metrics['metrics'] as $key => $value)
        <ul class="nav nav-pills" role="tablist">
          <li role="presentation">{{$key}}<span class="badge">{{$value}}</span></a></li>
        {{$value}}</span>

      </ul>
    </div>
    @endforeach
  </div>
</div>
@endforeach
@endif --}}




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
