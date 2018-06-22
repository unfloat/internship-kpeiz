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
		@if(isset($indicators))
		@foreach ($indicators as $label => $indicator)
		<div class="col-md-3 col-md-6">
			<div class="panel panel-white stats-widget">
				<div class="panel-body">
					<div class="pull-left">
						<span class="stats-number">{{$indicator}}</span>
						<p class="stats-info">{{ config('chartsLabels.'.$label)}}</p>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		@endif
	</div>
	@if(isset($finals))
	@foreach($finals as $finalkey => $final )
	<div class="col-md-12">
		@foreach ($final as $key => $charts)
		@foreach ($charts as $key => $chart)
		<div class="col-md-6">
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