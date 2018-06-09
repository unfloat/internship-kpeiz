@extends('layouts.main')
@section('content')
<div class="col-md-12">
    @include('layouts.partials.breadcrumbedplaylistheader')
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
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                        <thead>
                            <tr>
                                <th>Video Title</th>
                                <th>Published At</th>
                                <th>Vues</th>
                                <th>Likes</th>
                                <th>Commentaires</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Video Title</th>
                            <th>Published At</th>
                            <th>Vues</th>
                            <th>Likes</th>
                            <th>Commentaires</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @if(!isset($videodata))
                            <tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>
                            @endif
                            @if(isset($videodata))
                            @foreach($videodata['videos'] as $video)
                            <tr>
                                <th>{{$video['title']}}</th>
                                <th>{{$video['published_at']}}</th>
                                <th>{{isset($video['metrics']['viewCount']) ? $video['metrics']['viewCount'] : 0}}</th>
                                <th>{{isset($video['metrics']['likeCount']) ? $video['metrics']['likeCount'] : 0}}</th>
                                <th>{{isset($video['metrics']['commentCount']) ? $video['metrics']['commentCount'] : 0}}</th>
                                <th>
                                    <!--  <button class="btn btn-success"><a href="{{ url('/videometrics')}}">Details</a></button> -->
                                    <a href="{{ url('/spacevideometrics/'.$video['id']) }}" class="btn btn-xs btn-default">See metrics</i></a>
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
</div>

        @endsection