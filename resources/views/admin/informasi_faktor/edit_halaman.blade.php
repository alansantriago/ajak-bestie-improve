@extends('layouts.app', ['title' => __('Edit Informasi Faktor Jabatan '.$jabatan->nama_jabatan)])

@section('content')
@include('admin.header', ['halaman' => __('Edit Informasi Faktor Jabatan '.$jabatan->nama_jabatan)])
<div class="container-fluid mt--7">
  <div class="row justify-content-center">
    <div class="col-xl-8 order-xl-1 mb-3">
      {{-- Informasi Jabatan --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="col-xl-12 order-xl-1 mb-3">
            <h3 class="text-center mt-3">{{ __('Jabatan ').$jabatan->nama_jabatan }}</h3>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger my-2" role="alert">

              @foreach ($errors->all() as $error)

              <strong>{{ $error }}</strong><br>

              @endforeach

            </div>
            @endif
            @if (session('Errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('Errors') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
          </div>
          <div class="row align-items-center">
            <div class="col-12 text-center">


            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="pl-lg-4">
            {{-- {{ dd($informasi_faktor->faktor->first()->data_faktor); }} --}}
            @if ($jabatan->jenis_jabatan != "Struktural")
            <script>
              window.onload = function() {
             btn9faktor();
            };
            </script>
            @else
            @if (($jenis_faktor == '6 Faktor')||($jenis_faktor == NULL))
            <script>
              window.onload = function() {
                btn6faktor();
            };
            </script>
            @else
            <script>
              window.onload = function() {
              btn9faktor();
              };
            </script>
            @endif
            @endif
            <script>
              function btn6faktor(){
                document.getElementById("btn9faktor").disabled = false;
                document.getElementById("btn6faktor").disabled = true;
              let faktor6 = document.getElementById("isifaktor6");
              faktor6.removeAttribute("hidden");
              let faktor9 = document.getElementById("isifaktor9");
              faktor9.setAttribute("hidden", "hidden");
              // faktor9.style.display === "none";
            }
            function btn9faktor(){
              document.getElementById("btn9faktor").disabled = true;
              document.getElementById("btn6faktor").disabled = false;
              let faktor6 = document.getElementById("isifaktor6");
              faktor6.setAttribute("hidden", "hidden");
              let faktor9 = document.getElementById("isifaktor9");
              faktor9.removeAttribute("hidden");
              // faktor9.style.display === "none";
            }
            </script>
            @if($jabatan->jenis_jabatan == 'Struktural')
            <button type="button" id="btn6faktor" class="btn btn-info btn6faktor" onclick="btn6faktor()">6
              Faktor</button>
            <button type="button" id="btn9faktor" class="btn btn-info btn9faktor" onclick="btn9faktor()">9
              Faktor</button>
            @else
            <button type="button" id="btn6faktor" class="btn btn-info btn6faktor" hidden onclick="btn6faktor()">6
              Faktor</button>
            <button type="button" id="btn9faktor" class="btn btn-info btn9faktor" hidden onclick="btn9faktor()">9
              Faktor</button>
            @endif
            <div id="isifaktor6" class="isifaktor6" hidden>
              @include('admin.informasi_faktor.faktor6')
            </div>
            <div id="isifaktor9" class="isifaktor9" hidden>
              @include('admin.informasi_faktor.faktor9')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    $(document).ready(function(){
   
  })
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush