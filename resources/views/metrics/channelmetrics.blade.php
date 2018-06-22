@extends('layouts.main')
@section('css')
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
  <div class="col-md-12">
    @if(isset($indicators))
    @foreach ($indicators as $key => $indicator)
    <div class="col-md-3 col-md-6">
      <div class="panel panel-white stats-widget">
        <div class="panel-body">
          <div class="pull-left">
            <span class="stats-number">{{end($indicator['values'])}}</span>
            <p class="stats-info">{{ config('chartsLabels.'.$key)}}</p>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>

    @if(isset($finals))
    @foreach($finals as $key => $final )
    @foreach ($final as $key => $charts)
    @foreach ($charts as $key => $chart)
    <div class="{{ $chart->type == 'line' ? 'col-md-12' : 'col-md-6' }}">
      <i class="{{$chart->type == 'pie' ? 'fa fa-pie-chart' : 'fa fa-area-chart'}}"></i> {{config('chartsLabels.'.$chart->title)}}
      <br><br>
      <div class="card-body">
        <canvas id="{{ $chart->id }}" width="100%" height="30"></canvas>
      </div>
    </div>
      <br/>
      @endforeach
      @endforeach
      @endforeach
      @endif
    </div>
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