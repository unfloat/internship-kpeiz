
<div class="panel panel-white">
    <div class="panel-body">
        <div class="panel-heading clearfix">
            <div class="row-fluid">
                <div class="span6 pull-left">
            <h4 class="panel-title">{{app('video')->title}}</h4>
            </div>
                <div class="span6 text-right">



            <a title="Choisir un Video" data-toggle="modal" data-target="#videoModal" class="left-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-file-video-o"><span class="span"> Video Filter </span></i></button></a>
        </div>
    </div>
</div>
</div>





<!-- Video Filter modal-->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title"  id="videoModalLabel" >Video Picker</h3>

            </div>
            <div class="modal-body">




                <form action= "{{ route('datePick')}}" class = "form-inline" method="post" data-toggle="validator">
                    {{ csrf_field() }}

                    <div class="col-sm-6">

                        <label for="">Choisir une video parmi la playlist {{app('playlist')->title}}</label><br>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Video
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">


                                @foreach($savedVideos as $id => $title)
                                    <li>

                                            {{ csrf_field() }}
                                            <a class="btn" href="{{ url('/videometrics/'.$id)}}">
                                                {{$title}}
                                            </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                        <br><br>
                    <div class="modal-footer">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


</div>


