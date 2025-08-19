@extends('dashboard.header', ['title' => __('Tentang')])

@section('content')
<header class="header-2">
  <div class="page-header min-vh-75"
    style="background-image: url(&#39;{{ asset('dashboard') }}/assets/img/GEDUNG.jpg&#39;);" loading="lazy">
    <span class="mask bg-gradient-dark opacity-5"></span>
    <div class="container ">
      <div class="row">
        <div class="text-center mx-auto my-auto">
          <h1 class="text-white mb-2">Tentang</h1>
          <p class="text-white opacity-8 lead ">Sistem Analisis Jabatan, Analisis Beban Kerja, Standar Kompetensi dan
            Evaluasi Jabatan<br>Pemerintah Provinsi Bengkulu</p>

        </div>
      </div>
    </div>
  </div>
</header>
<div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
  <section class="py-sm-7 py-2 position-relative">
    <div class="container">
      <div class="row">
        <div class="col-12 mx-auto">
          <div class="row py-5">
            <div class="col-lg-10 col-md-10 z-index-2 position-relative px-md-2 px-sm-5 mx-auto">

              <p class="text-lg mb-0 text-justify">
                <b>Sistem Analisis Jabatan, Analisis Beban Kerja, Standar Kompetensi dan Evaluasi Jabatan
                  Pemerintah Provinsi Bengkulu</b> ini dibangun dengan kerjasama oleh Prodi Informatika Fakultas Teknik
                Universitas Bengkulu tahun ajaran 2022/2023 melalui kegiatan Proyek Perangkat Lunak yang dimana salah
                satu studi bagi mahasiswa informatika UNIB dengan Dosen Pembimbing <b>Arie Vatresia, S.T., M.T.I.,
                  Ph.D.</b> dan Pembimbing Lapangan <b>Majulo Bilkhair, S.E., M.A.P
                </b><br>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- -------- START Features w/ pattern background & stats & rocket -------- -->
  <section class="pb-5 position-relative bg-gradient-dark mx-n3">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-start mb-5 mt-5">
          <h3 class="text-white z-index-1 position-relative">The Executive Team</h3>
          <p class="text-white opacity-8 mb-0"></p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6 col-12">
          <div class="card card-profile mt-4">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-12 mt-n5">
                <a href="javascript:;">
                  <div class="p-3 pe-md-0">
                    <img class="w-100 border-radius-md shadow-lg" src="{{ asset('assets') }}/img/dennys.png"
                      alt="image">
                  </div>
                </a>
              </div>
              <div class="col-lg-8 col-md-6 col-12 my-auto">
                <div class="card-body ps-lg-0">
                  <h5 class="mb-0">Azvadennys Vasiguhamiaz</h5>
                  <h6 class="text-info">Programmer</h6>
                  <p class="mb-0">Front-End and Back-End Website.<br>Email : <a
                      href="mailto:azvadenis@gmail.com">azvadenis@gmail.com</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row mt-4">
        <div class="col-lg-6 col-12">
          <div class="card card-profile mt-4 z-index-2">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-12 mt-n5">
                <a href="javascript:;">
                  <div class="p-3 pe-md-0">
                    <img class="w-100 border-radius-md shadow-lg" src="{{ asset('dashboard') }}/assets/img/iconuser.png"
                      alt="image">
                  </div>
                </a>
              </div>
              <div class="col-lg-8 col-md-6 col-12 my-auto">
                <div class="card-body ps-lg-0">
                  <h5 class="mb-0">Agnes Veranika</h5>
                  <h6 class="text-info">QA Tester</h6>
                  <p class="mb-0">Testing Website Before Deploy.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="card card-profile mt-lg-4 mt-5 z-index-2">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-12 mt-n5">
                <a href="javascript:;">
                  <div class="p-3 pe-md-0">
                    <img class="w-100 border-radius-md shadow-lg" src="{{ asset('dashboard') }}/assets/img/iconuser.png"
                      alt="image">
                  </div>
                </a>
              </div>
              <div class="col-lg-8 col-md-6 col-12 my-auto">
                <div class="card-body ps-lg-0">
                  <h5 class="mb-0">Desi Fitria</h5>
                  <h6 class="text-info">QA Tester</h6>
                  <p class="mb-0">Testing Website Before Deploy.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- -------- END Features w/ pattern background & stats & rocket -------- -->
  {{-- <section class="pt-4 pb-6" id="count-stats">
    <div class="container">
      <div class="row mb-7">
        <div class="col-lg-2 col-md-4 col-6 mb-4">
          <img class="w-100 opacity-7" src="../assets/img/logos/gray-logos/logo-coinbase.svg" alt="logo">
        </div>
        <div class="col-lg-2 col-md-4 col-6 mb-4">
          <img class="w-100 opacity-7" src="../assets/img/logos/gray-logos/logo-nasa.svg" alt="logo">
        </div>
        <div class="col-lg-2 col-md-4 col-6 mb-4">
          <img class="w-100 opacity-7" src="../assets/img/logos/gray-logos/logo-netflix.svg" alt="logo">
        </div>
        <div class="col-lg-2 col-md-4 col-6 mb-4">
          <img class="w-100 opacity-7" src="../assets/img/logos/gray-logos/logo-pinterest.svg" alt="logo">
        </div>
        <div class="col-lg-2 col-md-4 col-6 mb-4">
          <img class="w-100 opacity-7" src="../assets/img/logos/gray-logos/logo-spotify.svg" alt="logo">
        </div>
        <div class="col-lg-2 col-md-4 col-6 mb-4">
          <img class="w-100 opacity-7" src="../assets/img/logos/gray-logos/logo-vodafone.svg" alt="logo">
        </div>
      </div>
      <div class="row justify-content-center text-center">
        <div class="col-md-3">
          <h1 class="text-gradient text-info" id="state1" countTo="5234">0</h1>
          <h5>Projects</h5>
          <p>Of “high-performing” level are led by a certified project manager</p>
        </div>
        <div class="col-md-3">
          <h1 class="text-gradient text-info"><span id="state2" countTo="3400">0</span>+</h1>
          <h5>Hours</h5>
          <p>That meets quality standards required by our users</p>
        </div>
        <div class="col-md-3">
          <h1 class="text-gradient text-info"><span id="state3" countTo="24">0</span>/7</h1>
          <h5>Support</h5>
          <p>Actively engage team members that finishes on time</p>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- -------- START PRE-FOOTER 1 w/ SUBSCRIBE BUTTON AND IMAGE ------- -->

  <!-- -------- END PRE-FOOTER 1 w/ SUBSCRIBE BUTTON AND IMAGE ------- -->
</div>
@endsection