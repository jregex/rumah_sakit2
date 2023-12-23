<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin/assets') }}/img/hospital.ico">
    <link rel="icon" type="image/icon-x" href="{{ asset('assets/admin/assets') }}/img/hospital.ico">
    <title>
        {{ $title ?? 'Home' }} | Pelayanan Rumah Sakit
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/admin/assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/admin/assets') }}/css/nucleo-svg.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    @yield('datatables-css')
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/admin/assets') }}/css/argon-dashboard.min.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-gradient-success position-absolute w-100"></div>
    <x-navside />
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid pt-2 py-1 px-3">
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav ms-md-auto d-flex align-items-center justify-content-end">
                        <li class="nav-item d-xl-none px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-dark p-0" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-cog cursor-pointer me-1"></i>
                                <span class="d-sm-inline d-none">Profile</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 mb-3"
                                aria-labelledby="dropdownMenuButton1">
                                <li class="mb-2"><a class="dropdown-item dropdown-item  border-radius-md"
                                        href="{{ route('profile_') }}">Profile</a></li>
                                <li class="mb-2">
                                    <form action="{{ route('logout_') }}" method="post">@csrf<button type="submit"
                                            class="dropdown-item dropdown-item border-radius-md ">Logout</button></form>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content-admin')
            <footer class="footer pt-4 mt-2">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fas fa-fire"></i> by
                                <a href="#" class="font-weight-bold" target="_blank">221002</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/admin/assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets/admin/assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('assets/admin/assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets/admin/assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
    {{-- <script src="{{ asset('assets/admin/assets') }}/js/plugins/chartjs.min.js"></script> --}}
    @yield('datatables-js')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/admin/assets') }}/js/argon-dashboard.min.js"></script>
</body>

</html>
