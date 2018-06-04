<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Kpeiz</title>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/uniform/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/switchery/switchery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/css/jquery.datatables.min.css')}}"  type="text/css">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/css/jquery.datatables_themeroller.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" type="text/css">
    <!-- Theme Styles -->
    <link href="{{asset('css/space.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
    @yield('css')
    <!-- Styles -->
    <link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet ')}}">
    <!-- Theme Styles -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="page-header-fixed">
    <!-- Page Container -->
    <div class="page-container">
      @include('layouts.partials.sidebar')
      <!-- Page Content -->
      <div class="page-content">
        @include('layouts.partials.header')
        <!-- Page Inner -->
        <div class="page-inner">
          <!--   @if(Session::has('msg'))
          <div class="alert alert-{{  Session::get('msg')['type'] }} alert-dismissible" role="alert" style="margin-bottom:0;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{  Session::get('msg')['text'] }}
          </div>
          @endif -->
          <div class="page-title">
          </div>
          @yield('content')
          <!-- /Page Inner -->
          <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
      </div>
    </div>
    <!-- Javascripts -->
    <script src="{{asset('assets/plugins/jquery/jquery-3.1.0.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/plugins/uniform/js/jquery.uniform.standalone.js')}}"></script>
    <script src="{{asset('assets/plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('/js/space.min.js')}}"></script>
    <script src="{{asset('/js/pages/table-data.js')}}"></script>
    <script src="{{asset('/js/main.js')}}"></script>
    <script src="{{asset('assets/plugins/chartjs/chart.min.js')}}"></script>
    <script src="{{asset('assets/js/space.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('assets/plugins/d3/d3.min.js')}}"></script>
    <script src="{{asset('assets/plugins/nvd3/nv.d3.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.time.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.symbol.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.pie.min.js')}}"></script>
    {{-- <script src="{{asset('js/pages/chart.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script> --}}
    @yield('js')
  </body>
</html>