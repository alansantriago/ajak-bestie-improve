<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-4 pb-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/pemprov.png" class="navbar-brand-img mx-auto img-center mb-2"
                alt="...">

            <h2 class="mx-auto">AJAK-Bestie</h2>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/brand/user.png">
                        </span>
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
        <!-- Collapse -->
        <div class="collapse navbar-collapse " id="sidenav-collapse-main">
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
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none navbar-search-light">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="text" name="search" class="form-control form-control-rounded "
                        placeholder="{{ __('Search') }}" aria-label="Search" value="{{ request('search') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col-12">
                        <button class="btn btn-md btn-default mt-2"><a class="text-white"
                                href="{{ route('beranda') }}">
                                Beranda
                            </a></button>
                    </div>
                    {{-- <div class="col-4">
                        <button class="btn btn-md btn-default mt-2"><a class="text-white" href="{{ route('tentang') }}">
                                Tentang
                            </a></button>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-md btn-default mt-2"><a class="text-white" href="{{ route('kontak') }}">
                                Kontak
                            </a></button>
                    </div> --}}
                </div>

            </form>
            <hr class="my-2">
            <!-- Navigation -->
            <ul class="navbar-nav ">
                <li class="nav-item ">
                    <a class="nav-link {{ $active === 'home' ? ' active' : '' }}" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
            @if (auth()->user()->role == 'bkd')
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'informasijabatan' ? ' active' : '' }}"
                            href="{{ route('bkd.informasijabatan') }}">
                            <i class="fa-solid fa-address-card text-primary"></i>{{ __('Laporan Informasi Jabatan') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'laporan' ? ' active' : '' }}"
                            href="{{ route('bkd.rekapitulasi') }}">
                            <i class="fa-solid fa-briefcase text-purple"></i>{{ __('Rekapitulasi Jabatan') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'peta' ? ' active' : '' }}"
                            href="{{ route('bkd.petajabatan') }}">
                            <i class="fa-sharp fa-solid fa-circle-nodes"></i>{{ __('Peta Jabatan') }}
                        </a>
                    </li>
                </ul>
            @endif
            @if (auth()->user()->role != 'pimpinan' && auth()->user()->role != 'bkd')
                @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                    <h6 class="navbar-heading pt-3 text-muted">
                        <span class="docs-normal"> <i class="fa fa-database"></i> Database Master</span>
                    </h6>
                    <ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a class="nav-link {{ $active === 'user' ? ' active' : '' }}" href="/users">
                                <i class="fa fa-user text-blue"></i> {{ __('Kelola Akun User') }}
                            </a>
                        </li>
                        @if (auth()->user()->role == 'superadmin')
                            <li class="nav-item ">
                                <a class="nav-link {{ $active === 'opd' ? ' active' : '' }}" href="/dinas">
                                    <i class="fa fa-landmark text-orange"></i> {{ __('Kelola OPD') }}
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ $active === 'kompetensi' ? ' active' : '' }}"
                                    href="/manajerial">
                                    <i class="ni ni-single-copy-04 text-info"></i>
                                    {{ __('Kelola Kompetensi Manajerial') }}
                                </a>

                            </li>

                            <li class="nav-item ">
                                <a class="nav-link {{ $active === 'faktor' ? ' active' : '' }}"
                                    href="/faktor-jabatan">
                                    <i class="ni ni-chart-bar-32 text-orange"></i> {{ __('Kelola Faktor Jabatan') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin')
                    <h6 class="navbar-heading p-0 text-muted pt-2">
                        <span class="docs-normal">Jabatan Master</span>
                    </h6>
                    <ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a class="nav-link {{ $active === 'jabatan' ? ' active' : '' }}" href="#navbar-examples"
                                data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="navbar-examples">
                                <i class="fa fa-user-secret text-danger"></i>
                                <span class="nav-link-text">{{ __('Kelola Jabatan') }}</span>
                            </a>

                            <div class="ml-3 collapse" id="navbar-examples">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/jabatan-struktural">
                                            {{ __(' Jabatan Struktural') }}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/jabatan-fungsional">
                                            {{ __(' Jabatan Fungsional') }}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/jabatan-pelaksana">
                                            {{ __(' Jabatan Pelaksana') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $active === 'faktorjabatan' ? ' active' : '' }}"
                                href="#navbar-infromasi-faktor" data-toggle="collapse" role="button"
                                aria-expanded="true" aria-controls="navbar-infromasi-faktor">
                                <i class="fa-solid fa-circle-info text-success"></i>
                                <span class="nav-link-text">{{ __('Kelola Informasi Faktor Jabatan') }}</span>
                            </a>

                            <div class="ml-3 collapse" id="navbar-infromasi-faktor">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item ">
                                        <a class="nav-link"
                                            href="/informasi-faktor-jabatan-struktural?jenis_jabatan=Struktural">
                                            {{ __(' Jabatan Struktural') }}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link"
                                            href="/informasi-faktor-jabatan-fungsional?jenis_jabatan=Fungsional">
                                            {{ __(' Jabatan Fungsional') }}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link"
                                            href="/informasi-faktor-jabatan-pelaksana?jenis_jabatan=Pelaksana">
                                            {{ __(' Jabatan Pelaksana') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ $active === 'kompetensijabatan' ? ' active' : '' }}"
                                href="#navbar-kompetensi" data-toggle="collapse" role="button" aria-expanded="true"
                                aria-controls="navbar-kompetensi">
                                <i class="fa-regular fa-clipboard text-teal"></i>
                                <span class="nav-link-text">{{ __('Kelola Standar Kompetensi Jabatan') }}</span>
                            </a>
                            <div class="ml-3 collapse" id="navbar-kompetensi">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/standar-kompetensi-jabatan-struktural">
                                            {{ __(' Jabatan Struktural') }}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/standar-kompetensi-jabatan-fungsional">
                                            {{ __(' Jabatan Fungsional') }}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/standar-kompetensi-jabatan-pelaksana">
                                            {{ __(' Jabatan Pelaksana') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                @endif
                <h6 class="navbar-heading p-0 text-muted pt-2">
                    <span class="docs-normal">Entry Data</span>
                </h6>
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'analisisjabatan' ? ' active' : '' }}"
                            href="/analisis_jabatan">
                            <i class="fa-solid fa-address-card text-primary"></i>{{ __('Analisis Jabatan') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'analisisbebankerja' ? ' active' : '' }}"
                            href="/analisis_beban_kerja">
                            <i class="fa-solid fa-briefcase text-purple"></i>{{ __('Analisis Beban Kerja') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'analisiskorelasi' ? ' active' : '' }}"
                            href="/analisis_korelasi">
                            <i class="fa-sharp fa-solid fa-circle-nodes"></i>{{ __('Analisis Korelasi Jabatan') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'analisisteknis' ? ' active' : '' }}"
                            href="/analisis_kompetensi_teknis">
                            <i class="fa-brands fa-hive text-orange"></i>{{ __('Analisis Kompetensi Teknis') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'biodatajabatan' ? ' active' : '' }}"
                            href="/biodata_jabatan">
                            <i class="fa-solid fa-briefcase text-black"></i>{{ __('Biodata Jabatan') }}
                        </a>
                    </li>
                </ul>

                <h6 class="navbar-heading p-0 text-muted pt-2">
                    <span class="docs-normal">Report</span>
                </h6>
                {{-- <i class="fa-solid fa-print"></i> --}}
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link {{ $active === 'laporan' ? ' active' : '' }}" href="#laporan"
                            data-toggle="collapse" role="button" aria-expanded="true" aria-controls="laporan">
                            <i class="fa-solid fa-print text-danger"></i>
                            <span class="nav-link-text">{{ __('Laporan') }}</span>
                        </a>
                        <div class="ml-3 collapse show" id="laporan">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/laporan-informasi-jabatan">
                                        {{ __('Informasi Jabatan') }}
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/laporan-rekap">
                                        {{ __('Rekapitulasi Jabatan') }}
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/laporan-faktor-jabatan">
                                        {{ __('Informasi Faktor Jabatan') }}
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/laporan-kompetensi-jabatan">
                                        {{ __('Standar Kompetensi Jabatan') }}
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link" href="/laporan-biodata">
                                        {{ __('Rekap Biodata Jabatan') }}
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link {{ $active === 'peta' ? ' active' : '' }}"
                                        href="/peta-jabatan"> {{ __('Peta Jabatan') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            @endif
        </div>
    </div>
</nav>
