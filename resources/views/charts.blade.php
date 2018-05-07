@extends('layouts.app')


@section('content')

<div class="container">
	{{-- @include('layouts.partials.breadcrumbs.breadcrumbsBasicInfo') --}}


  		<!-- Breadcrumbs-->
  		<ol class="breadcrumb">
  			<li class="breadcrumb-item">
  				<a href="#">Dashboard</a>
  			</li>
  			<li class="breadcrumb-item active">Cards</li>
  		</ol>
  		<h1>Cards</h1>
  		<hr>

     @if(isset($infos))
    <div class="row grid-divider">
    <div class="col-sm-4">
      <div class="col-padding">
       
        <h3>{{ $infos['title'] }}</h3>
        
        <p>Title</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="col-padding">
      	 <h3>{{ $infos['description'] }}</h3>
        
        <p>Description  </p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="col-padding">
        <h3>Column 3</h3>
        <p>Lorem ipsum</p>
      </div>
    </div>
    </div>
    @endif


  	<!-- /.container-fluid-->
    <!-- /.content-wrapper-->


	@if(isset($charts))
	@foreach($charts as $c)
	<div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-area-chart"></i> {{$c->title}}</div>
			<div class="card-body">
				<canvas id="{{$c->id}}" width="100%" height="30"></canvas>
			</div>
			<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
		</div>
		@endforeach
		@endif

	</div>





	@endsection


	@section('scripts')


	<script src="/vendor/chart.js/Chart.min.js"></script>
	@if(isset($charts))
	@foreach($charts as $c)
	@include('charts.'.$c->type,['chart' => $c])
	@endforeach
	@endif



<script src="{{asset('assets/plugins/jquery/jquery-3.1.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/uniform/js/jquery.uniform.standalone.js')}}"></script>
<script src="{{asset('assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/space.min.js')}}"></script>
<script src="{{asset('assets/plugins/pages/table-data.js')}}"></script>

<script>
 $(document).ready(function(){$("#dataTable").DataTable()});
</script>

@endsection



