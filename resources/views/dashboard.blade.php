@extends('layouts.main')
@section('content')
<div class="panel panel-white">
    <div class="panel-heading">
        <h4 class="panel-title">Selected Channels</h4>
    </div>
    <div class="panel-body">
        @if(Session::has('msg'))
        <div class="alert alert-{{  Session::get('msg')['type'] }} alert-dismissible" role="alert" style="margin-bottom:0;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{  Session::get('msg')['text'] }}
        </div>
        @endif
        <div class="table-responsive">
            <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Channel Title</th>
                        <th>SUBSCRIBERS</th>
                        <th>VIEWS</th>
                        <th>Published At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Channel Title</th>
                    <th>SUBSCRIBERS</th>
                    <th>VIEWS</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
                <tbody>
                    @if(!isset($channeldata))
                    <tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>
                    @endif
                    @if(isset($channeldata))
                    @foreach($channeldata as $channel)
                    <tr>
                        <th>{{$channel['title']}}</th>
                        <th>{{ isset($channel['metrics']['subscriberCount']) ? $channel['metrics']['subscriberCount'] : 'unknown' }}</th>
                        <th>{{ isset($channel['metrics']['viewCount']) ? $channel['metrics']['viewCount'] : 'unknown'}}</th>
                        <th>{{$channel['published_at']}}</th>
                        <th><a href="{{ url('/channelmetrics/'.$channel['id']) }}" class="btn btn-xs btn-default">{{$channel['id'] == app('channel')->id ? 'Selected' : 'See metrics' }}</a></th>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection