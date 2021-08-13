<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'emt | inspect') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/default-dashboard/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/font-icons/fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="default-sidebar">
    @auth
    <!-- Tab Mobile View Header -->
    <header class="tabMobileView header navbar fixed-top d-lg-none">
        <div class="nav-toggle">
            <a href="javascript:void(0);" class="nav-link sidebarCollapse" data-placement="bottom">
                <i class="flaticon-menu-line-2"></i>
            </a>
            <a href="/" class=""> <img src="{{ asset('assets/img/logo-3.png') }}" class="img-fluid" alt="logo"></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="nav-item d-lg-none">
                <form class="form-inline justify-content-end" role="search">
                    <input type="text" class="form-control search-form-control mr-3">
                </form>
            </li>
        </ul>
    </header>
    <!-- Tab Mobile View Header -->

    <!--  BEGIN NAVBAR  -->
    <header class="header navbar fixed-top navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse d-none d-lg-block" data-placement="bottom"><i
                class="flaticon-menu-line-2"></i></a>

        <ul class="navbar-nav flex-row ml-lg-auto">
            <li class="nav-item dropdown user-profile-dropdown ml-lg-0 mr-lg-2 ml-3 order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-user-12"></span>
                </a>

                <div class="dropdown-menu  position-absolute" aria-labelledby="userProfileDropdown">
                    <a class="dropdown-item" href="{{ route('edit-user') }}">
                        <i class="mr-1 flaticon-user-6"></i> <span>My Profile</span>
                    </a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                        <i class="mr-1 flaticon-power-button"></i> <span>{{ __('Log Out') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </header>
    @endauth
    
    
    <main class="main-container" id="container">
        <div class="overlay"></div>
        <div class="cs-overlay"></div>

        @auth
            @include('sidebar')
        @endauth

        @yield('content')
    </main>

    @auth
    <footer class="footer-section theme-footer">
        <div class="footer-section-1  sidebar-theme"></div>

        <div class="footer-section-2 container-fluid">
            <div class="row">
                <div id="toggle-grid" class="col-xl-7 col-md-6 col-sm-6 col-12 text-sm-left text-center">
                    <ul class="list-inline links ml-sm-5">
                        <li class="list-inline-item mr-3">
                            <a href="{{ url()->action('MainController@index') }}">Home</a>
                        </li>
                    </ul>
                </div>

                <div class="col-xl-5 col-md-6 col-sm-6 col-12">
                    <ul
                        class="list-inline mb-0 d-flex justify-content-sm-end justify-content-center mr-sm-3 ml-sm-0 mx-3">
                        <li class="list-inline-item  mr-3">
                            <p class="bottom-footer">
                                &#xA9; 2020 <a target="_blank" href="">EMT-Technology Distribution</a>
                            </p>
                        </li>

                        <li class="list-inline-item align-self-center">
                            <div class="scrollTop"><i class="flaticon-up-arrow-fill-1"></i></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    @endauth
</body>

</html>
