<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{ app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}">
<head>

    @include('dashboard.layouts.head')

</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->

  @include('dashboard.layouts.header')

  <!-- ////////////////////////////////////////////////////////////////////////////-->

  @include('dashboard.layouts.sidebar')



  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- Revenue, Hit Rate & Deals -->

@yield('content')


        <!-- Analytics map based session -->
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->

  @include('dashboard.layouts.footer')
    </body>
</html>
