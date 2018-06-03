<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/space.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body class="page-header-fixed">
<div class="page-container">
    <div class="page-content" style="width: 100%">
        <div class="page-inner">

            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="span6 pull-left">
                            <h4> Channel Report <strong> Kpeiz </strong> </h4>
                    </div>
                </div>
            </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="span6 pull-left">
                            <h4> published at <strong>{{$published_at}}</strong> </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="span6 pull-left">
                            <!-- <div class="panel-heading clearfix"> -->
                        <img src="{{$thumbnail}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="span6 pull-left">
                            <!-- <div class="panel-heading clearfix"> -->
                            <h4> Active Channel <strong> {{ app('channel')->title }}</strong> </h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    @if(isset($indicators))
                        @foreach ($indicators as $key => $indicator)
                            <div class="col-md-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">{{end($indicator['values'])}}</span>
                                            <p class="stats-info">{{ config('chartsLabels.'.$key)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
