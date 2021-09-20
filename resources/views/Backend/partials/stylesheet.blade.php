<link rel="icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon.ico')}}"/>
<link href="{{asset('backend/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('backend/assets/js/loader.js')}}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{asset('backend/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('backend/assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
  <link href="{{asset('backend/plugins/table/datatable/dt-global_style.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('backend/plugins/table/datatable/custom_dt_custom.css')}}" rel="stylesheet" type="text/css" />
@stack('backend-stylesheet')
