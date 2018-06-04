<div class="page-sidebar">
    <a class="logo-box"  href="{{ url('/home')}}">
        <span>Kpeiz</span>
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
                        <li><a href="{{ url('/channelmetrics')}}">Channel's Metrics</a></li>
                        <li><a href="{{ url('/playlists')}}">Playlists</a></li>
                        <li><a href="{{ url('/videos')}}">Videos</a></li>                    </ul>
                    </li>
                    {{-- <li class="active-page"> --}}
                        <li>
                            <a href="{{ url('/channelreports')}}">
                                <i class="menu-icon fa fa-file-text-o"></i><span>Rapports</span>
                            </a>
                        </li>
                        <li class="menu-divider"></li>
                        <li>
                            <a href="{{ url('/mail')}}">
                                <i class="menu-icon fa fa-at"></i><span>Contact</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>