<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{config('app.name','kitcoglobal')}}</title>
    <!-- Favicon -->
    <link rel="shortcut" type="image/png" href="{{ secure_asset('website_theme_back_end/assets/images/logo/favicon.png') }}" />
    <!-- plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/bootstrap/dist/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/PACE/themes/blue/pace-theme-minimal.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" />
    <!-- page plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/nvd3/build/nv.d3.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/sweetalert.css') }}" />
    <!-- page plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/selectize/dist/css/selectize.default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/datatables/media/css/jquery.dataTables.css') }}" />    
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/select2/select2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/select2/select2-bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/bootstrap4-toggle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" />


    <!-- core css -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/ei-icon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/themify-icons.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/developer.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/toastr.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('resources/assets/css/jquery.countdownTimer.css') }}" />
    @yield('stylesheets')

    <script src="{{ secure_asset('resources/assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/PACE/pace.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/jquery.select2.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/bootstrap.jasny.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/sweetalert/lib/sweet-alert.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/jquery.mask.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/application.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/php.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/holder.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/core.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/toastr.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/common.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/dependent_dropdowns.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/bootstrap4-toggle.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/jquery.countdownTimer.js') }}"></script>
    @yield('scripts')
</head>
    <!-- core css -->
<body>
    <div class="app">
        <div class="layout">
            <!-- Page Container START -->
            <div class="page-container" style="">
                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <!-- Content Wrapper END -->
                <!-- Footer START -->
                @include('elements.footer')
                <!-- Footer END -->
            </div>
        </div>
    </div>
    <!-- build:js resources/assets/js/vendor.js -->
    <!-- plugins js -->
    <!-- endbuild -->
    <!-- page plugins js -->
    <script src="{{ secure_asset('resources/assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/maps/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/d3/d3.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/nvd3/build/nv.d3.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/jquery.sparkline/index.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/chart.js/dist/Chart.min.js') }}"></script>
    <!-- core js -->
    <script src="{{ secure_asset('resources/assets/js/app.js') }}"></script>
    <!-- endbuild -->
    <!-- page js -->
    <script src="{{ secure_asset('resources/assets/js/dashboard/dashboard.js') }}"></script>
    <script src="{{ secure_asset('//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js') }}"></script>
    <!-- page plugins js -->
    <script src="{{ secure_asset('resources/assets/vendors/selectize/dist/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/vendors/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ secure_asset('resources/assets/js/parsley.min.js') }}"></script>
    <!-- page js -->
    <script src="{{ secure_asset('resources/assets/js/forms/form-elements.js') }}"></script>
        <!-- page plugins js -->
    <script src="{{ secure_asset('resources/assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- page js -->
    <script src="{{ secure_asset('resources/assets/js/forms/form-validation.js') }}"></script>
    @yield('scripts')
    <script type="text/javascript">
        core.init();
        var webrootUrl = "{{ secure_asset('/') }}";
    </script>
</body>

</html>







