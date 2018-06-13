@extends('layouts.main')
@section('content')
<br>
<h1>Contact</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('msg'))
    <div class="alert alert-{{  Session::get('msg')['type'] }} alert-dismissible" role="alert" style="margin-bottom:0;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{  Session::get('msg')['text'] }}
    </div>
    @endif
<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Send us an Email</h4>
    </div>
    <div class="panel-body">
        <form action="{{url('/sendmail')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="message">Name</label>
                <input class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" placeholder="Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection