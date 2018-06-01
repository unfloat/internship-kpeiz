@extends('layouts.main')
@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="row">

	    @include('layouts.partials.breadcrumbedplaylistheader')

	@if(Session::has('msg'))
	<div class="alert alert-{{  Session::get('msg')['type'] }} alert-dismissible" role="alert" style="margin-bottom:0;">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		{{  Session::get('msg')['text'] }}
	</div>
	@endif
	<div class="col-md-8">
		@if(isset($playlistsdata))
		@foreach($playlistsdata['playlists'] as $key => $playlist)
		<div class="panel panel-white">
			<div class="panel-heading clearfix">
				<h4 class="panel-title">
				<div class="row-fluid">
					<div class="span6 pull-left">
						<p>{{$playlist['title']}}</p>
					</div>
					<div class="span6 text-right">
						<p>{{$playlist['published_at']}}</p>
					</div>
				</div>
				</h4>
			</div>
			<div class="panel-body">
				<div id="grid-gallery" class="grid-gallery">
					<section class="grid-wrap">
						<div class="grid col-md-12">
							<figure>
								@foreach ($playlist['data'] as $label => $info)
								@if ($label === "thumbnail")
								<div class="col-md-12">
									<img src="{{$info}}" alt="img02" style="    height: auto;
									width: 100%;">
								</div>
								@endif
								@endforeach
								@foreach ($playlist['metrics'] as $label => $indicator)
								<figcaption><p>{{ config('chartsLabels.'.$label)}}</p>
								<h3>{{$indicator}}</h3>
								</figcaption>
								@endforeach
							</figure>
						</div>
					</section>
				</div>
			</div>
		</div>
		@endforeach
		@endif
	</div>
	<div class="col-md-8">
		@if(isset($playlistsdata))
		@foreach($playlistsdata['videos'] as $key => $video)
		<div class="panel panel-white">
			<div class="panel-heading clearfix">
				<h4 class="panel-title">
				<div class="row-fluid">
					<div class="span6 pull-left">
						<p>{{$video['title']}}</p>
					</div>
					<div class="span6 text-right">
						<p>{{$video['published_at']}}</p>
					</div>
				</div>
				</h4>
			</div>
			<div class="panel-body">
				<div id="grid-gallery" class="grid-gallery">
					<section class="grid-wrap">
						<div class="grid col-md-12">
							<figure>
								@foreach ($video['data'] as $label => $info)
								@if ($label === "thumbnail")
								<div class="col-md-12">
									<img src="{{$info}}" alt="img02" style="    height: auto;
									width: 100%;">
								</div>
								@endif
								@endforeach
								@foreach ($video['metrics'] as $label => $indicator)
								<figcaption><p>{{ config('chartsLabels.'.$label)}}</p>
								<h3>{{$indicator}}</h3>
								</figcaption>
								@endforeach
							</figure>
						</div>
					</section>
				</div>
			</div>
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
	<script src="{{asset('/js/pages/table-data.js')}}"></script>
	@endsection