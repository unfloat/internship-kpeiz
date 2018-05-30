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

                        <th>Video Title</th>
                        <th>Published At</th>
                        <th>Vues</th>
                        <th>Likes</th>
                        <th>Dislikes</th>
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
                        <th>Dislikes</th>
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


                        <th>{{$metrics['viewCount'] }}</th>
                        <th>{{$metrics['likeCount']}}</th>
                        <th>{{$metrics['dislikeCount']}}</th>
                        <th>{{$metrics['commentCount']}}</th>



                        <th>

                                <!--  <button class="btn btn-success"><a href="{{ url('/videometrics')}}">Details</a></button> -->
                                 <a href="{{ url('/videometrics/'.$video['id']) }}" class="btn btn-xs btn-default">
                                    <i class="fa fa-pencil"></i></a>



                            </th>

                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection
