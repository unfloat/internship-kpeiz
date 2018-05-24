@extends('layouts.main')

@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection

@section('content')



<div class="row">
	@include('layouts.partials.breadcrumbedheader')
		@include('layouts.partials.breadcrumbedplaylistheader')
	@include('layouts.partials.breadcrumbedvideoheader')

	@if(isset($videos))




	@foreach($videos as $id => $data)
	<div class="col-md-6">
		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">{{$id}}</h4>
				</div>
				<div class="panel-body">

					{{-- <div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="{{$data}}" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;" ></iframe>
					</div> --}}

					<img src="{{$data}}" class="img-fluid">
					<div class="panel-footer">
						@if(isset($indicators))

						<div class="caption">

						</div>
						@endif
					</div>
				</div>
			</div>

		</div>
	</div>
	@endforeach
	@endif



	@if(isset($finals))
	@foreach($finals as $finalkey => $final )
	<div class="col-md-6">
		@foreach ($final as $key => $charts)
		@foreach ($charts as $key => $chart)
		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">{{ 'Chart : '.$chart->title }}</h4>
				</div>
				<canvas id="{{ $chart->id }}" width="578" height="289"></canvas>
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
