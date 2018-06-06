<div class="breadcrumb-header">
    <div class="panel panel-white">
        <div class="panel-body">
            <div class="row-fluid">
                <div class="span6 pull-left">
                    <!-- <div class="panel-heading clearfix"> -->
                    <h4> Channel <strong> {{ app('channel')->title }}</strong></h4>
                    <h4> Active Playlist <strong> {{ app('playlist')->title }}</strong></h4>
                </div>
                <div class="span6 text-right">
                <!-- </div>
                <div class="panel-body"> -->
                    <a title="Choisir une Playlist" data-toggle="modal" data-target="#savedPlaylistModal" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-youtube-play"><span class="span"> Playlist Filter</span></i></button></a>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="savedPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="savedPlaylistModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title"  id="savedPlaylistModalLabel" >Saved Playlist Pick</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Playlist
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            @if (isset($savedPlaylists))

                            @foreach($savedPlaylists as $id => $title)

                            <li>
                                {{ csrf_field() }}
                                <a class="btn" href="{{ url('/videos/'.$id)}}">
                                    {{$title}}
                                </a>

                                <!--  <form action= "{{ url('/setplaylist')}}" class = "form-inline" method="POST" data-toggle="validator">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary">
                                    <input type="hidden" name="id" value="{{ $id }}">{{$title}}
                                    </button>
                                </form> -->
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>