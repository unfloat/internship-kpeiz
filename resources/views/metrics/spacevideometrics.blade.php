@extends('layouts.main')
@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Line Chart</h4>
				</div>
				<div id="nvd1"><svg></svg></div>
			</div>
		</div>
		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Group/Stacked Bar Chart</h4>
				</div>
				<div id="nvd3"><svg></svg></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Comulative Line Chart</h4>
				</div>
				<div id="nvd2"><svg></svg></div>
			</div>
		</div>
		<div class="panel panel-white">
			<div class="panel-body">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Stacked Area Chart</h4>
				</div>
				<div id="nvd4"><svg></svg></div>
			</div>
		</div>
	</div>
	</div><!-- Row -->
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