<nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container px-4">
        <h1><a class="text-white" href="{{ route('home') }}">
                AJAK-Bestie
            </a></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-3 collapse-brand content-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/pemprov.png">
                        </a>
                    </div>
                    <div class="col-5">
                        <h2>AJAK-Bestie</h2>
                    </div>
                    <div class="col-4 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navbar items -->

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('beranda') }}">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('tentang') }}">
                        Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('kontak') }}">
                        Kontak
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('login') }}">

                        <span class="nav-link-inner--text">{{ __('Login') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
