<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Hotelly</title>

    <!-- Favicons -->
    <link href="{{asset('templates/user')}}/assets/img/favicon.png" rel="icon">
    <link href="{{asset('templates/user')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('templates/user')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('templates/user')}}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="{{asset('templates/user')}}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{asset('templates/user')}}/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('templates/user')}}/assets/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
    <link href="{{asset('templates/user')}}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('templates/user')}}/assets/vendor/venobox/venobox.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('templates/user')}}/assets/css/style.css" rel="stylesheet">

</head>

<body data-spy="scroll" data-target="#navbar-example">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex">
            <div class="logo mr-auto">
                <h1 class="text-light"><a href="{{route('beranda')}}"><span>HOTEL</span>LY</a></h1>
            </div>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="{{Request::segment(1) == null ? 'active' : ''}}"><a href="{{route('beranda')}}">Beranda</a></li>
                    <li class="{{Request::segment(1) == 'about' ? 'active' : ''}}"><a href="{{route('beranda')}}/#about">About</a></li>
                    <li class="{{Request::segment(1) == 'data-kamar' ? 'active' : ''}}"><a href="{{route('beranda.kamar')}}">Kamar</a></li>
                    <li class="{{Request::segment(1) == 'data-fasilitas' ? 'active' : ''}}"><a href="{{route('beranda.fasilitas')}}">Fasilitas</a></li>
                    <li class="{{Request::segment(1) == 'portfolio' ? 'active' : ''}}"><a href="{{route('beranda')}}/#portfolio">Galery</a></li>
                    @guest
                    @if (Route::has('login'))
                    <li>
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    @if (Auth::user()->role == "adm")
                    <li>
                        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </nav><!-- .nav-menu -->

        </div>
    </header><!-- End Header -->

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer>
        <div class="footer-area-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="copyright text-center">
                            <p>
                                &copy; Copyright <strong>Hotelly</strong>. All Rights Reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{asset('templates/user')}}/assets/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/appear/jquery.appear.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/knob/jquery.knob.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/parallax/parallax.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/wow/wow.min.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{asset('templates/user')}}/assets/vendor/venobox/venobox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('templates/user')}}/assets/js/main.js"></script>
    @yield('script')

</body>

</html>
