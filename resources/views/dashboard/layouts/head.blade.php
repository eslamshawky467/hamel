<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
@yield('title')
  </title>
  <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->


   <link href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/'.changeDirection().'/vendors.css') }}">
  
   <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/css/datatable/css/dataTables.dataTables.min.css')}}"/>
   
     <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/css/datatable/css/jquery.dataTables.min.css')}}"/>

  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/'.changeDirection().'/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/'.changeDirection().'/custom-rtl.css') }}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/'.changeDirection().'/core/menu/menu-types/vertical-menu-modern.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/'.changeDirection().'/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/vendors/css/charts/morris.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/fonts/simple-line-icons/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('app-assets/'.changeDirection().'/core/colors/palette-gradient.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ loadFiles('assets/css/style-rtl.css')}}">
  <!-- END Custom CSS-->
  <script src="{{URL::asset('admin_assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>


