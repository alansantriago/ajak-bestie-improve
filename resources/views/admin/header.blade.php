<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
  style="background-image: url('/argon/img/brand/pemprovlogo.png'); background-size: 15%; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <div class="container-fluid">
    <div class="header-body">
      <!-- Card stats -->
      <div class="row align-items-center py-0">
        <div class="col-lg-6 col-12">
          <ol>
            <h6 class="h2 text-white d-inline-block mb-0">{{ $halaman }}</h6>
          </ol>
        </div>
        <div class="col-lg-6 col-12 text-right">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-2">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white"><i
                    class="fas fa-home text-white mx-1"></i>
                  <bold>Dashboard</bold>
                </a></li>
              <li class="breadcrumb-item active " aria-current="page">{{ $halaman }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>