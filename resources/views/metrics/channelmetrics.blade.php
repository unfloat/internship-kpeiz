@extends('layouts.main')
@section('css')

@endsection

@section('content')
 @include('layouts.partials.breadcrumbedheader')
<div class="row">
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
  <div class="col-md-12">

    @if(isset($finals))
    @foreach($finals as $key => $final )

    <!-- <div class="">{{ 'Channel : '.$key }} </div> -->
    @foreach ($final as $key => $charts)
    @foreach ($charts as $key => $chart)
    <i class="fa fa-area-chart"></i> {{config('chartsLabels.'.$chart->title)}}
    <div class="card-body">
      <canvas id="{{ $chart->id }}" width="100%" height="30"></canvas>
    </div>

    <br/>

    @endforeach
    @endforeach
    @endforeach
    @endif
  </div>
{{--
  @if(isset($bestPlaylists))
  @foreach($bestPlaylists as $bestPlaylist)
  <div class="col-lg-3 col-md-3">
   <div class="thumbnail" >
    <img src={{$bestPlaylist['data']['thumbnail']}} alt="...">
    <div class="caption">
      <p>{{$bestPlaylist['title']}}</p>
      <ul class="list-unstyled">
        @foreach($bestPlaylist['metrics'] as $key => $value)
        <li>
          {{ config('chartsLabels.'.$key)}}<span>{{$value}}</span>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

</div>
@endforeach
@endif



@if(isset($bestVideos))
@foreach($bestVideos as $bestVideo)
<div class="thumbnail">
  <img src={{$bestVideo['data']['thumbnail']}} alt="...">
  <div class="caption">
    <p>{{$bestVideo['title']}}</p>
    @foreach($bestVideo['metrics'] as $key => $value)
    <p>{{$key}}<span>{{$value}}</span></p>
  </div>
  @endforeach
</div>
</div>
@endforeach
@endif --}}

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
