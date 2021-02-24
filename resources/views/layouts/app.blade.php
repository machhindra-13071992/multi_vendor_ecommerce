<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{config('app.name','ATHENA')}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="resources/assets/images/logo/favicon.png">

    <!-- plugins css -->
    <link rel="stylesheet" href="resources/assets/vendors/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="resources/assets/vendors/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="resources/assets/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />

    <!-- page plugins css -->
    <link rel="stylesheet" href="resources/assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="resources/assets/vendors/nvd3/build/nv.d3.min.css" />

    <!-- core css -->
    <link href="resources/assets/css/ei-icon.css" rel="stylesheet">
    <link href="resources/assets/css/themify-icons.css" rel="stylesheet">
    <link href="resources/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="resources/assets/css/animate.min.css" rel="stylesheet">
    <link href="resources/assets/css/app.css" rel="stylesheet">
    <link href="<?php echo url('/').'/resources/assets/css/developer.css'; ?>" rel="stylesheet">
    <!--@yield('stylesheets')-->
</head>


<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Athena') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- build:js resources/assets/js/vendor.js -->
    <!-- plugins js -->
    <script src="resources/assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="resources/assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="resources/assets/vendors/bootstrap/dist/js/bootstrap.js"></script>
    <script src="resources/assets/vendors/PACE/pace.min.js"></script>
    <script src="resources/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <!-- endbuild -->

    <!-- page plugins js -->
    <script src="resources/assets/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="resources/assets/js/maps/jquery-jvectormap-us-aea.js"></script>
    <script src="resources/assets/vendors/d3/d3.min.js"></script>
    <script src="resources/assets/vendors/nvd3/build/nv.d3.min.js"></script>
    <script src="resources/assets/vendors/jquery.sparkline/index.js"></script>
    <script src="resources/assets/vendors/chart.js/dist/Chart.min.js"></script>

    <!-- build:js resources/assets/js/app.min.js -->
    <!-- core js -->
    <script src="resources/assets/js/app.js"></script>
    <!-- endbuild -->

    <!-- page js -->
    <script src="resources/assets/js/dashboard/dashboard.js"></script>
    <!--@yield('scripts')-->
</body>

</html>