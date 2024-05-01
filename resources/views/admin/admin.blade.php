<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Page Title -->
    <title>@yield('title') | Administration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- styleko -->
    <link rel="stylesheet" href="{{ asset('dist/css/styleko.css') }}">
    <style>
        /* Ajoutez une classe CSS pour la barre de navigation fixe */
        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            /* z-index: 1000; */
            /* Assure que la barre de navigation apparaît au-dessus des autres éléments */
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @php
            $route = request()->route()->getName();
        @endphp

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div class="mx-auto">
                <h2 class="brand"><strong>
                        <!-- Brand Logo -->
                        <img src="{{ asset('dist/img/iconMID.png') }}" alt="" class="brand-image img-circle"
                            style="width: 70px; height: 70px; object-fit: cover;"> Ministère de l'Intérieur
                    </strong>
                </h2>
            </div>
        </nav>

        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-white-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center">
                    <div class="image">
                        @if (Auth::user()->image_users)
                            <img class="img-circle elevation-2" style="width: 70px; height: 70px; object-fit:cover;"
                                class="img-circle elevation-2" src="{{ Auth::user()->image_url() }}" alt="User Image"
                                alt="User Avatar">
                        @endif
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <style>
                    .nav-link p {
                        margin: 0;
                    }
                </style>

                <nav class="">
                    <ul class="nav nav-pills nav-sidebar flex-column nav" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon"></i>
                                <p class="black-text">
                                    {{ Auth::user()->name }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('profile.edit') }}" class="nav-link">
                                        <i class="fas fa-user nav-icon" style="color: rgb(0, 160, 5);"></i>
                                        <p>Mon Compte</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.utilisateur.index') }}" class="nav-link">
                                        <i class="fas fa-users" style="color: rgb(0, 160, 5);"></i>
                                        <p>Gérer les utilisateurs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <!-- Authentication -->
                                    <form class="nav-link" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <i class="fas fa-sign-out-alt nav-icon" style="color: rgb(0, 160, 5);"></i>
                                        <button class="btn btn-reset">Se déconnecter</a>
                                    </form>
                                </li>
                        </li>
                    </ul>
                    <li class="nav-item">
                        <a href="{{ route('admin.demande.index') }}" @class(['nav-link', 'active' => str_contains($route, 'demande.')])>
                            <i class="fas fa-tasks" style="color: rgb(0, 160, 5);"></i>
                            <p>
                                Demandes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.service.index') }}" @class(['nav-link', 'active' => str_contains($route, 'service.')])>
                            <i class="fas fa-building" style="color: rgb(0, 160, 5);"></i>
                            <p>
                                Departements
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.fonction.index') }}" @class(['nav-link', 'active' => str_contains($route, 'fonction.')])>
                            <i class="fas fa-briefcase" style="color: rgb(0, 160, 5);"></i>
                            <p>
                                Fonctions
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.niveau.index') }}" @class(['nav-link', 'active' => str_contains($route, 'niveau.')])>
                            <i class="fas fa-graduation-cap" style="color: rgb(0, 160, 5);"></i>
                            <p>
                                Niveau d'Etude
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.accepte.index') }}" @class(['nav-link', 'active' => str_contains($route, 'accepte.')])>
                            <i class="fas fa-user-graduate" style="color: rgb(0, 160, 5);"></i>
                            <p>
                                Stagiaire
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ministere.index') }}" @class(['nav-link', 'active' => str_contains($route, 'ministere.')])>
                            <i class="fas fa-info-circle" style="color: rgb(0, 160, 5);"></i>
                            <p>
                                A propos
                            </p>
                        </a>
                    </li>
                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        @yield('content')
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

</body>

</html>
