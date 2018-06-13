<div class="breadcrumb-header">
    <div class="panel panel-white">
        <div class="panel-body">
            <div class="row-fluid">
                <div class="span6 pull-left">
                    <!-- <div class="panel-heading clearfix"> -->
                    <figure>
                        <img src="{{ app('channel')->data['thumbnail'] }}" class="img-fluid">
                    </figure>
                    <h4> Active Channel <strong> {{ app('channel')->title }}</strong></h4>
                </div>
                <div class="span6 text-right">
                <!-- </div>
                <div class="panel-body"> -->
                    <a title="Choisir une chaine" data-toggle="modal" data-target="#savedChannelModal" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-youtube-play"><span class="span"> Channel Filter</span></i></button></a>
                    <button class="btn btn-primary">
                    <a href="{{ route('downloadPDF',['download'=>'pdf']) }}"><span class="span">Download PDF</span></a>
                    </button>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- savedChannelModal modal-->
    <div class="modal fade" id="savedChannelModal" tabindex="-1" role="dialog" aria-labelledby="savedChannelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title"  id="savedChannelModalLabel" >Saved Channel Pick</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Channel
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($savedChannels as $channel)
                            <li>
                                <form action= "{{ url('/setaccount')}}" class = "form-inline" method="POST" data-toggle="validator">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary">
                                    <input type="hidden" name="id" value="{{ $channel['id'] }}">{{$channel['title']}}
                                    </button>
                                </form>
                            </li>
                            @endforeach
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