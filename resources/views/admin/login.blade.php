<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin/assets') }}/img/logo_smart.ico">
    <link rel="icon" type="image/icon-x" href="{{ asset('assets/admin/assets') }}/img/logo_smart.ico">
    <title>
        {{ $title ?? 'Home' }} | Sembilan 9 Media
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/admin/assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/admin/assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/admin/assets') }}/css/style2.min.css" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Log In</h4>
                                    <p class="mb-0">Enter your Username or Email and password to log in</p>
                                </div>
                                <div class="card-body">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <span class="alert-text text-white">{{ session()->get('success') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @elseif (session()->has('failed'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span class="alert-text text-white">{{ session()->get('failed') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form role="form" method="post" action="{{ route('login-check') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Username / Email" name="username" aria-label="Email"
                                                id="username">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                placeholder="Password" aria-label="Password" id="password">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="showPass">
                                            <label class="form-check-label" for="showPass">Show Password</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-dark btn-lg w-100 mt-4 mb-0">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden bg-light"
                                style="background-image: url('/assets/admin/assets/img/logo1.png');
                            background-size: 50%;background-repeat:no-repeat;background-position:center;background-color:#fcfcfc">
                                {{-- <span class="mask bg-primary opacity-6"></span> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/admin/assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets/admin/assets') }}/js/core/bootstrap.min.js"></script>
    <script>
        let showpass = document.querySelector('#showPass');
        showpass.addEventListener('click', () => {
            let password = document.querySelector('#password');
            if (password.type === 'password') {
                password.setAttribute('type', 'text');
            } else {
                password.setAttribute('type', 'password');
            }
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
