@extends('layouts.main')

@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection

@section('content')


@include('layouts.partials.breadcrumbedheader')
@include('layouts.partials.breadcrumbedplaylistheader')

<div class="row">



	<div class="col-md-12">

		@if(isset($playlist))

		@foreach($playlist as $key => $data)



		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">{{$key}}</h4>
				</div>
				<div class="panel-body">

					{{-- <div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="{{$data}}"></iframe>
					</div> --}}
					<img src="{{$data}}" alt="">
					<div class="panel-footer">

						<div class="caption">
							@if(isset($indicators))
							@foreach ($indicators as $key => $indicator)

							<span class="stats-number">{{end($indicator['values'])}}</span>
							<p class="stats-info">{{ config('chartsLabels.'.$key)}}</p>
						</div>

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
