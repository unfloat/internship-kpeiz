@extends('layouts.main')
@section('css')
@endsection
@section('content')
<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Contact Us</h4>
    </div>
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">FULL NAME</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-Default">
                </div>
            </div>
            <div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-Default">
                </div>
            </div>
            <div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="input-Default">
                </div>
            </div>
        </form>
    </div></div>
    @endsection