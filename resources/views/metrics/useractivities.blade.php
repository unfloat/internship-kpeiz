@extends('layouts.main')

@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection

@section('content')



<div class="row">
  <div class="col-md-12">
@if(isset($videos_data))
  @foreach($videos_data as $key => $video_data)
  <div class="col-lg-6 col-md-6">
   {{-- <div class="thumbnail" > --}}


    <img src={{$video_data['data']['thumbnail']}} alt={{$video_data['title']}}>
    <div class="caption">
      {{-- <p>{{$bestPlaylist['title']}}</p> --}}
      <p>{{$video_data['title']}}</p>

    </div>
  </div>


@endforeach
@endif
</div>

  <div class="col-md-12">
<div class="col">
	@if(isset($finals))
	@foreach($finals as $key => $final )
	{{ 'Video : '.$key }}
	@foreach ($final as $key => $charts)
	@foreach ($charts as $key => $chart)
	{{$chart->title}}
	<div class="card-body">
		<canvas id="{{ $chart->id }}" width="100%" height="30"></canvas>
	</div>
	@endforeach
	@endforeach
	@endforeach
	@endif
</div>
</div>
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
