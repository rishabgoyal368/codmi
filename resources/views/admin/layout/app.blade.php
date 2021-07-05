<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{url('/admin')}}">{{env('APP_NAME')}}</a>
                <a class="navbar-brand brand-logo-mini" href="{{url('/admin')}}"><img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{Auth::guard('admin')->user()->getProfileImage()}}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{Auth::guard('admin')->user()->name}}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{url('/admin/my-profile')}}">
                                <i class="mdi mdi-face mr-2 text-success icon"></i> My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('/admin/logout')}}">
                                <i class="mdi mdi-logout mr-2 text-primary"></i> Signout
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            @include('admin.layout.menu')
            <div class="main-panel">
                @include('admin.layout.flash-message')
                @yield('content')
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{env('APP_NAME')}} {{date('Y')}}</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

    @yield('external_script')
</body>

</html>