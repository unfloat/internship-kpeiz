@extends('layouts.main')
@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection
@section('content')
<div class="row">

	@include('layouts.partials.breadcrumbedvideoheader')
	@if(Session::has('msg'))
	<div class="alert alert-{{  Session::get('msg')['type'] }} alert-dismissible" role="alert" style="margin-bottom:0;">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		{{  Session::get('msg')['text'] }}
	</div>
	@endif


<div class="col-md-12">
	<div class="col-md-6">
	@if(isset($videos))
	@foreach($videos as $id => $data)


		<div class="panel panel-white">
			<div class="panel-heading clearfix">
				<h4 class="panel-title">{{$id}}</h4>
			</div>
			<div class="panel-body">
				<img src="{{$data}}" class="img-fluid">
			</div>
		</div>

	@endforeach
	@endif
	</div>
		<div class="col-md-6">
			<div style="display: inline-block;">
				<div class="pull-left">
					@if(isset($indicators))
					<ul>
					@foreach ($indicators[$id] as $label => $indicator)
					<li>
					<span class="stats-number">{{$indicator}}</span>
					<p class="stats-info">{{ config('chartsLabels.'.$label)}}</p>
				</li>
					@endforeach
				</ul>
					@endif

			</div>
		</div>
	</div>
</div>


	@if(isset($finals))
		@foreach($finals as $finalkey => $final )
		<div class="col-md-12">



		@foreach ($final as $key => $charts)
		@foreach ($charts as $key => $chart)


		<div class="{{ $chart->type == 'line' ? 'col-md-12' : 'col-md-6' }}">


		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title"> Chart :{{ config('chartsLabels.'.$chart->title) }}</h4>
				</div>
				<canvas id="{{ $chart->id }}" width="578" height="289"></canvas>
			</div>
		</div>
		</div>
		@endforeach
		@endforeach

</div>
	@endforeach
	@endif
</div>
@endsection
@section('js')
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