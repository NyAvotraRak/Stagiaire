<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>@yield('title') | Administration</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/animate-3.7.0.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-4.1.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleko.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area">
        <div id="header" id="home" style="width: 93%">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="index.html"><img src="{{ asset('images/logo/logo.png') }}" alt=""
                                title="" /></a>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="/">Home</a></li>
                            <li><a href="/">departments</a></li>
                            <li class="menu-has-children"><a href="">Stage</a>
                                <ul>
                                    <li><a href="/">En ettente</a></li>
                                    <li><a href="/">Entretien</a></li>
                                    <li><a href="/">Demande refusée</a></li>
                                    <li><a href="/">Stage en cours</a></li>
                                    <li><a href="/">Stage achevé</a></li>
                                </ul>
                            </li>
                            <li class="menu-has-children">{{ Auth::user()->name }}
                                <ul>
                                    <div class="mt-3 space-y-1">
                                        <x-responsive-nav-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-responsive-nav-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Se deconnecter') }}
                                            </x-responsive-nav-link>
                                        </form>
                                    </div>
                                </ul>
                            </li>
                            {{-- <li><a href="/">Contact</a></li> --}}

        {{-- <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Se deconnecter') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div> --}}
                        </ul>
                    </nav><!-- #nav-menu-container -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    @if (@session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

    <!-- Footer Area Starts -->
    {{-- <footer class="footer-area section-padding">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-3">
                    </div>
                    <div class="col-xl-5 offset-xl-1 col-lg-6">
                    </div>
                    <div class="col-xl-3 offset-xl-1 col-lg-3">
                        <div class="single-widge-home">
                            <h3 class="mb-4">Facebook feed</h3>
                            <div class="feed">
                                <img src="{{ asset('images/feed1.jpg') }}" alt="feed">
                                <img src="{{ asset('images/feed2.jpg') }}" alt="feed">
                                <img src="{{ asset('images/feed3.jpg') }}" alt="feed">
                                <img src="{{ asset('images/feed4.jpg') }}" alt="feed">
                                <img src="{{ asset('images/feed5.jpg') }}" alt="feed">
                                <img src="{{ asset('images/feed6.jpg') }}" alt="feed">
                                <img src="{{ asset('images/feed7.jpg') }}" alt="feed">
                                <img src="{{ asset('images/feed8.jpg') }}" alt="feed">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <span>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="social-icons">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}
    <!-- Footer Area End -->

    <!-- Javascript -->
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap-4.1.3.min.js') }}"></script>
    <script src="{{ asset('js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('js/vendor/owl-carousel.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/vendor/superfish.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>



</body>

</html>
