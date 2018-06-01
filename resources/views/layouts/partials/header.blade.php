<div class="page-header">
    <div class="search-form">
        <form action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Type something...">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="close-search" type="button"><i class="icon-close"></i></button>
                </span>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="logo-sm">
                    <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                    <a class="logo-box" href="index.html"><span>app('name')</span></a>
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <i class="fa fa-angle-down"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button" ><i class="fa fa-bars"></i></a></li>
                    <li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
                    <li><a href="javascript:void(0)" id="search-button"><i class="fa fa-search"></i></a></li>



                </ul>

                <ul class="nav navbar-nav navbar-right">


                        <a title="Choisir une Chaine" data-toggle="modal" data-target="#channelModal" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-youtube-play"><span class="span"> Channel</span></i></button></a>

                        <a title="Deconnexion" data-toggle="modal" data-target="#leaveModal" class=" right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><button type="button" class="btn btn-default"><i class="fa fa-sign-out"><span class="span"> Deconnexion</span></i></button></a>


                </ul>








        </div>
    </nav>

        </div><!-- /.navbar-collapse -->
                <!-- Logout Modal-->
                <div class="modal fade" id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="leaveModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="leaveModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="{{ url('/logout')}}">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- channel modal-->
                <div class="modal fade" id="channelModal" tabindex="-1" role="dialog" aria-labelledby="channelModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header">
                                <h5 class="modal-title"  id="channelModalLabel" >Channel Pick</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action= "{{ url('/channel')}}" class = "form-inline" method="post" data-toggle="validator">
                                    {{ csrf_field() }}
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Channel URL</label>
                                                <input type="text" class="form-control" name="urlchannel"
                                                placeholder="Url Channel">
                                            </div>

                                        </div>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Choisir</button>
                                </form>
                            </div>
                            <div class="modal-footer">



                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
