<!DOCTYPE html>
<html lang="<?php echo isset($_COOKIE['language']) ? $_COOKIE['language'] : "en"; ?>">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8" />
    <title>Digital Seva</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Digital Seva" />
    <meta name="keywords" content="Digital Seva" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--Template style -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/flaticon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/owl.theme.default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/nice-select.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/datatables.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/dropify.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/front_end/css/developer.css') }}" />
    <link rel="shortcut" type="image/png" href="{{ secure_asset('resources/assets/front_end/imtend/favicon.png') }}" />
    <!--favicon-->
    <!--custom js files-->
    <script src="{{ secure_asset('resources/assets/front_end/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/modernizr.js') }}"></script>

    <script src="{{ secure_asset('resources/assets/front_end/js/jquery.menu-aim.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/plugin.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/jquery.countTo.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/dropify.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/datatables.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/jquery.inview.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/owl.carousel.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/front_end/js/calculator.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/common.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/parsley.min.js') }}"></script>
    <!-- custom js-->
</head>
<!-- color picker start -->
<body>
  <!-- preloader Start -->
    <!-- <div id="preloader">
        <div id="status">
            <img src="{{ secure_asset('resources/assets/images/frontend/loader.gif') }}" id="preloader_image" alt="loader">
        </div>
    </div> -->
    <!-- Top Scroll Start -->
    <a href="javascript:" id="return-to-top"> <i class="fas fa-angle-double-up"></i></a>
    <!-- Top Scroll End -->
        @include('elements.frontend_header_inner')
       {{--  @include('elements.frontend_sidebar') --}}
        @yield('content')
        @include('elements.frontend_footer')
    <!--  footer  wrapper end -->      
    <!-- main box wrapper End-->
    <script type="text/javascript">
        var webrootUrl = "{{ secure_asset('/') }}";
    </script>
</body>
</html>