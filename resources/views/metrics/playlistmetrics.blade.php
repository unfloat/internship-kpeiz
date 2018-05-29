@extends('layouts.main')
@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection
@section('content')
@include('layouts.partials.breadcrumbedheader')
@include('layouts.partials.breadcrumbedplaylistheader')
<div class="row">
	<!--
	<div class="col-md-12"> -->
		@if(isset($playlists))
		@foreach($playlists as $key => $playlist)
		<div class="col-md-6">
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">{{$playlist}}</h4>
					</div>
					@if(isset($infos))
						@foreach ($infos[$key] as $info)
					<div class="panel-body">


							<img src="{{$info['thumbnail']}}" alt="">


					</div>



					<div class="panel-footer">
						<div class="caption">
							 <div class="pull-left">
          <span class="stats-number">{{$info['published_at']}}</span>
          <p class="stats-info">{{ config('chartsLabels.'.$info)}}</p>
        </div>






						</div>

					</div>
					@endforeach
			@endif
				</div>
			</div>


		</div>
		@endforeach
			@endif
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