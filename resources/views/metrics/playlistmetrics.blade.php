@extends('layouts.main')
@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection
@section('content')
@include('layouts.partials.breadcrumbedheader')

<div class="row">
	   @if(Session::has('msg'))
                  <div class="alert alert-{{  Session::get('msg')['type'] }} alert-dismissible" role="alert" style="margin-bottom:0;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{  Session::get('msg')['text'] }}
                  </div>
                @endif
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
						@foreach ($infos[$key] as $label => $info)
					<div class="panel-body">
							@if ($label === "thumbnail")
							<img src="{{$info}}">
							@endif

						    @if ($label === "published_at")
							   <p class="stats-info">{{config('chartsLabels.'.$label)}}</p>
							   <span class="stats-number">{{$info}}</span>
							   @endif


					</div>

					@endforeach
					@endif


					<div class="panel-footer">
						<div class="pull-left">
									@if(isset($indicators))
						@foreach ($indicators[$key] as $label => $indicator)

          <span class="stats-number">{{$indicator}}</span>
          <p class="stats-info">{{ config('chartsLabels.'.$label)}}</p>
          @endforeach
			@endif
        </div>

        </div>

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
		@endsection