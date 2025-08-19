@extends('dashboard.header', ['title' => __('Selamat Datang')])

@section('content')
<header class="header-2">
  <div class="page-header min-vh-100"
    style="background-image: url(&#39;{{ asset('dashboard') }}/assets/img/GEDUNG.jpg&#39;);" loading="lazy">
    <span class="mask bg-gradient-dark opacity-5"></span>
    <div class="container ">
      <div class="row">
        <div class="text-center mx-auto my-auto">
          <h1 class="text-white mb-2">AJAK-Bestie</h1>
          <p class="text-white opacity-8 lead ">Sistem Analisis Jabatan, Analisis Beban Kerja, Standar Kompetensi dan
            Evaluasi Jabatan<br>Pemerintah Provinsi Bengkulu</p>
          {{-- <div class="buttons">
            <button type="button" class="btn btn-white mt-4">Read More</button> --}}
            {{-- <button type="button" class="btn text-white shadow-none mt-4">Read more</button> --}}
            {{--
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</header>

@endsection
@push('js')
<script>
  //   setTimeout(function() {
  
//       document.location.href = '/login';
// }, 5000);
</script>
@endpush