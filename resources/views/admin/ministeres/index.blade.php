<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Ministere | Administration</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/animate-3.7.0.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-4.1.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        section {
            margin-top: 12%;

        }
    </style>
</head>

<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area">
        <div id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="" title="" /></a>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="index.html">Home</a></li>
                            <li><a href="departments.html">departments</a></li>
                            <li><a href="doctors.html">doctors</a></li>
                            <li class="menu-has-children"><a href="">Pages</a>
                                <ul>
                                    <li><a href="about.html">about us</a></li>
                                    <li><a href="elements.html">elements</a></li>
                                </ul>
                            </li>
                            <li class="menu-has-children">{{ Auth::user()->name }}
                                <ul>
                                    <li><a href="blog-home.html">
                                            <div class="mt-3 space-y-1">
                                                <x-responsive-nav-link :href="route('profile.edit')">
                                                    {{ __('Profile') }}
                                                </x-responsive-nav-link>
                                        </a></li>
                                    <li><a href="blog-details.html">
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-responsive-nav-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                    {{ __('Se deconnecter') }}
                                                </x-responsive-nav-link>
                                            </form>
                                        </a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav><!-- #nav-menu-container -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Welcome Area Starts -->
    <section class="welcome-area section-padding3">
        <div class="container">
            <div class="row">
                @foreach ($ministeres as $ministere)
                    <div class="col-lg-5 align-self-center">
                        <div class="welcome-img">
                            <img src="{{ asset('images/doctor2.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="welcome-text mt-5 mt-lg-0">
                            <h2>@yield('title')</h2>
                            <h2>{{ $ministere->image_ministere }}</h2>
                            <h3>{{ $ministere->titre }}</h3>
                            <p>{{ $ministere->description_ministere }}</p>
                            <a href="{{ route('admin.ministere.edit', $ministere) }}"
                                class="template-btn mt-3">Modifier</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Welcome Area End -->

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
