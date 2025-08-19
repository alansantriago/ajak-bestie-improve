<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark border-bottom " id="navbar-main">
    <div class="container-fluid">
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action=""
            method="GET">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" name="search" placeholder="Search" type="text"
                        value="{{ request('search') }}">
                </div>
            </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            {{-- <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('beranda') }}">
                    Beranda
                </a>
            </li> --}}

            <li>
                <a class="nav-link text-white mx-3" href="{{ route('beranda') }}">
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
            <li>
                <a href="#" class="text-white mx-3">
                    @php
                        if (auth()->user()->role == 'user') {
                            namadinas(auth()->user()->id);
                        } elseif (auth()->user()->role == 'admin') {
                            echo 'Administrator';
                        } elseif (auth()->user()->role == 'superadmin') {
                            echo 'Super Administrator';
                        }
                    @endphp
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/brand/user.png">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
