<div class="breadcrumb-header">
    <div class="row">
        <div class="col-sm-8" > {{-- col-sm- --}}

            <p><!-- {{ (app('playlist') != null) ? app('playlist')->title : 'All Playlists'}} --> </p>
        </div>
        <div class="col-sm-4"> {{-- col-sm-6  --}}

            <a title="Choisir une playist" data-toggle="modal" data-target="#playistModal" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-calendar"><span class="span"> Playlists Filter</span></i></button></a>
        </div>
    </div>

     <!-- savedChannelModal modal -->
    <div class="modal fade" id="playistModal" tabindex="-1" role="dialog" aria-labelledby="playistModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!-- Modal content -->
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title"  id="playistModalLabel" >Channel's Playlists Pick</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select from Playlists
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            @foreach($playlists as $key => $playlist)




                            <li>
                                 <input type="hidden" name="id" value={{ $key }}>
                                <form action= "{{ url('/setplaylist')}}" class = "form-inline" method="POST" data-toggle="validator">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary">
                                    <input type="hidden" name="id" value="{{ $key }}">{{$playlist}}
                                    </button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="btn btn-primary" type="submit" >Choisir</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
