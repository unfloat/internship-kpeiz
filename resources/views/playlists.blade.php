@extends('layouts.main')
@section('content')
<div class="col-md-12">
    @include('layouts.partials.breadcrumbedheader')
</div>
<div class="col-md-12">
    @if(Session::has('msg'))
    <div class="alert alert-{{  Session::get('msg')['type'] }} alert-dismissible" role="alert" style="margin-bottom:0;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{  Session::get('msg')['text'] }}
    </div>
    @endif
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Playlists</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                    <thead>
                        <tr>
                            <th>Playlist Title</th>
                            <th>Published At</th>
                            <th>Videos</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Playlist Title</th>
                        <th>Published At</th>
                        <th>Videos</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @if(!isset($playlistsdata))
                        <tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>
                        @endif
                        @if(isset($playlistsdata))
                        @foreach($playlistsdata['playlists'] as $playlist)
                        <tr>
                            <th>{{$playlist['title']}}</th>
                            <th>{{$playlist['published_at']}}</th>
                            <th>{{$playlist['metrics']['item_count']}}</th>
                            <th>
                                <a href="{{ url('/videos/'.$playlist['id']) }}" class="btn btn-xs btn-default">See videos</a>
                            </th>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection