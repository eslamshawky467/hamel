<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <style>
       </style>
        <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet"/>

    <link  href="{{asset('user/css')}}/bootstrap.min.css" rel="stylesheet">
    <link  href="{{asset('user')}}/jquery.countdown.min" rel="stylesheet">

    <link href="{{asset('user')}}/user2.css"  rel="stylesheet">
  

    <link rel="stylesheet" href="{{asset('user/icons-1.8.1/font')}}/bootstrap-icons.css">
    



</head>

<body>
    

        
        @yield('content')

       
        <script src="{{asset('admin/vendors/jquery/dist')}}/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{asset('admin/vendors/bootstrap/dist/js')}}/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="{{asset('admin/vendors/fastclick/lib')}}/fastclick.js"></script>
        <!-- NProgress -->
        <script src="{{asset('admin/vendors/nprogress')}}/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="{{asset('admin/vendors/Chart.js/dist')}}/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="{{asset('admin/vendors/gauge.js/dist')}}/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{asset('admin/vendors/bootstrap-progressbar')}}/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="{{asset('admin/vendors/iCheck')}}/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="{{asset('admin/vendors/skycons')}}/skycons.js"></script>
        <!-- Flot -->
        <script src="{{asset('admin/vendors/Flot')}}/jquery.flot.js"></script>
        <script src="{{asset('admin/vendors/Flot')}}/jquery.flot.pie.js"></script>
        <script src="{{asset('admin/vendors/Flot')}}/jquery.flot.time.js"></script>
        <script src="{{asset('admin/vendors/Flot')}}/jquery.flot.stack.js"></script>
        <script src="{{asset('admin/vendors/Flot')}}/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="{{asset('admin/vendors/flot.orderbars/js')}}/jquery.flot.orderBars.js"></script>
        <script src="{{asset('admin/vendors/flot-spline/js')}}/jquery.flot.spline.min.js"></script>
        <script src="{{asset('admin/vendors/flot.curvedlines')}}/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="{{asset('admin/vendors/DateJS/build')}}/date.js"></script>
        <!-- JQVMap -->
        <script src="{{asset('admin/vendors/jqvmap/dist')}}/jquery.vmap.js"></script>
        <script src="{{asset('admin/vendors/jqvmap/dist/maps')}}/jquery.vmap.world.js"></script>
        <script src="{{asset('admin/vendors/jqvmap/examples/js')}}/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{asset('admin/vendors/moment/min')}}/moment.min.js"></script>
        <script src="{{asset('admin/vendors/bootstrap-daterangepicker')}}/daterangepicker.js"></script>
        <script src="{{asset('admin/build/js')}}/custom.min.js"></script>




        <!-- Custom Theme Scripts -->
        
           
         
         
        @yield('scripts')

    </body>
    </html>