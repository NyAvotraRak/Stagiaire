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
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleko.css') }}">
</head>

<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area">
        <div id="header" id="home" class="custom-header">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="" title="" /></a>
                    </div>
                    @php
                        $route = request()->route()->getName();
                    @endphp
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li><a href="{{route('admin.demande.index')}}" @class(['nav-link', 'active' => str_contains($route, 'demande.')])>Demandes</a></li>
                            <li><a href="{{route('admin.service.index')}}" @class(['nav-link', 'active' => str_contains($route, 'service.')])>Departements</a></li>
                            <li><a href="{{route('admin.accepte.index')}}" @class(['nav-link', 'active' => str_contains($route, 'accepte.')])>Stagiaires</a></li>
                            <li class="menu-has-children"><a>Plus</a>
                                <ul>
                                    <li><a href="{{route('admin.fonction.index')}}">Fonctions</a></li>
                                    <li><a href="{{route('admin.niveau.index')}}">Niveaux</a></li>
                                    <li><a href="{{route('admin.ministere.index')}}">A propos</a></li>
                                </ul>
                            </li>
                            <li class="menu-has-children"><a>{{ Auth::user()->name }}</a>
                                <ul>
                                    <li><a href="{{route('admin.utilisateur.index')}}">Gerer les comptes</a></li>
                                    <li><a href="blog-home.html">
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

    {{-- @if (@session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    @yield('content')


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

</html>
