 <div class="page-sidebar">
                <a class="logo-box"  href="{{ url('/home')}}">
                    <span>Kpeiz</span>
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li>
                                <a href="{{ url('/home')}}">
                                    <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0);">
                                    <i class="menu-icon  icon-show_chart"></i><span>Metriques</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('/channelmetrics')}}">Channel KPI</a></li>
                                    <li><a href="{{ url('/playlists')}}">Playlists</a></li>
                                    <li><a href="{{ url('/videos')}}">Videos</a></li>
                                    <li><a href="{{ url('/channelactivities')}}">User Activities</a></li>

                                </ul>
                            </li>


                            {{-- <li class="active-page"> --}}


                            <li>
                                <a href="{{ url('/channelreports')}}">
                                    <i class="menu-icon fa fa-file-text-o"></i><span>Rapports</span>
                                </a>
                            </li>


                            <li class="menu-divider"></li>
                            <li>
                                <a href="index.html">
                                    <i class="menu-icon icon-help_outline"></i><span>lorem</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html">
                                    <i class="menu-icon icon-public"></i><span>ipsum</span><span class="label label-danger">1.0</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
