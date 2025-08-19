<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link href="{{ asset('argon') }}/img/brand/pemprovlogo.png" rel="icon" type="image/png">
    <title>
        {{ $title }} | AJAK-Bestie
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('dashboard') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('dashboard') }}/assets/css/material-kit.css?v=3.0.3" rel="stylesheet" />
</head>

<body class="presentation-page bg-gray-200">
    <!-- Navbar -->
    <div class=" position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark navbar-absolute bg-dark shadow-none">
                    <div class="container">

                        <h4><a class=" text-white" href="/" rel="tooltip" title="Designed and Coded by Creative Tim"
                                data-placement="bottom" target="_blank">AJAK-Bestie</a></h4>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbar-header-2" aria-controls="navbar-header-2" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar-header-2">
                            <ul class="navbar-nav mx-auto">

                            </ul>

                            <ul class="nav navbar-nav nav-bordered">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('beranda') }}">
                                        Beranda
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('tentang') }}">
                                        Tentang
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('kontak') }}">
                                        Kontak
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">Login
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    @yield('content')
    @include('dashboard.footer')
