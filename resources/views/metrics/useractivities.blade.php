@extends('layouts.main')

@section('css')
{{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> --}}
@endsection

@section('content')



<div class="row">


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
