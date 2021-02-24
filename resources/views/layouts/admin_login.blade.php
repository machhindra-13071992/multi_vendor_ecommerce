<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ secure_asset('resources/assets/images/logo/favicon.png') }}">
    <title>{{config('app.name','DigitalSeva')}}</title>
    <!-- Favicon -->
    <link rel="shortcut" type="image/png" href="{{ secure_asset('resources/assets/images/logo/favicon.png') }}" />
    <!-- plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/bootstrap/dist/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/PACE/themes/blue/pace-theme-minimal.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" />
    
    <!-- core css -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/ei-icon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/themify-icons.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/developer.css') }}" />
    @yield('stylesheets')
    <script src="{{ secure_asset('resources/assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/PACE/pace.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <!-- page plugins js -->
    <script src="{{ secure_asset('resources/assets/js/parsley.min.js') }}"></script>
    @yield('scripts')
</head
<!-- color picker start -->
<body>
  <!-- preloader Start -->
    <!-- <div id="preloader">
        <div id="status">
            <img src="{{ secure_asset('resources/assets/images/frontend/loader.gif') }}" id="preloader_image" alt="loader">
        </div>
    </div> -->
    <!-- Top Scroll Start -->
    <!--<a href="javascript:" id="return-to-top"> <i class="fas fa-angle-double-up"></i></a>
    <!-- Top Scroll End -->
        @yield('content')
    <!--  footer  wrapper end -->      
    <!-- main box wrapper End-->
    <script type="text/javascript">
        var webrootUrl = "{{ secure_asset('/') }}";
    </script>
</body>
</html>