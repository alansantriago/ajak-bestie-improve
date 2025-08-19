@extends('layouts.app', ['title' => __('Tambah Faktor')])

@section('content')
@include('admin.header', ['halaman' => __('Tambah Faktor Fungsional & Pelaksana')])
{{-- @include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->name,
'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your
projects or assigned tasks'),
'class' => 'col-lg-7'
]) --}}
<div class="container-fluid mt--7">
  <div class="row justify-content-center">

    <div class="col-xl-8 order-xl-1">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <h3 class="text-center ">{{ __('Tambah Faktor') }}</h3>
          </div>
          @if (session('success'))
          <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif @if (session('failed'))
          <div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
            {{ session('failed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>

        <div class="card-body">
          <form method="post" action="/insert-faktor" autocomplete="off">

            @csrf

            <h4 class="heading-small text-muted mb-4">{{ __('Informasi Faktor Jabatan') }}</h4>

            <div class="pl-lg-4">
              <div class="form-group{{ $errors->has('nama_faktor') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-nama_faktor">{{ __('Nama Faktor') }}</label>
                <input type="text" name="nama_faktor" id="nama_faktor"
                  class="form-control form-control-alternative{{ $errors->has('nama_faktor') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Pilih Tingkat dan level Faktor Faktor') }}" value="{{ old('nama_faktor') }}"
                  required readonly autofocus>

                @if ($errors->has('nama_faktor'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nama_faktor') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('tingkat') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="tingkat">{{ __('Tingkat Faktor') }}</label>
                <select
                  class="tingkat form-select form-control form-control-alternative{{ $errors->has('tingkat') ? ' is-invalid' : '' }}"
                  name="tingkat" id="tingkat" aria-label="Default select example" required onchange="namafaktor()">
                  <option @if(old("tingkat")=='' ) selected @endif value='' disabled>Pilih Tingkat Faktor</option>
                  <option @if(old("tingkat")=='Tingkat Faktor 1' ) selected @endif value='Tingkat Faktor 1'>Faktor 1
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 2' ) selected @endif value='Tingkat Faktor 2'>Faktor 2
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 3' ) selected @endif value='Tingkat Faktor 3'>Faktor 3
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 4' ) selected @endif value='Tingkat Faktor 4'>Faktor 4
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 5' ) selected @endif value='Tingkat Faktor 5'>Faktor 5
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 6' ) selected @endif value='Tingkat Faktor 6'>Faktor 6
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 7' ) selected @endif value='Tingkat Faktor 7'>Faktor 7
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 8' ) selected @endif value='Tingkat Faktor 8'>Faktor 8
                  </option>
                  <option @if(old("tingkat")=='Tingkat Faktor 9' ) selected @endif value='Tingkat Faktor 9'>Faktor 9
                  </option>
                </select>

                @if ($errors->has('tingkat'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('tingkat') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="level">{{ __('Level Faktor') }}</label>
                <select
                  class="level form-select form-control form-control-alternative{{ $errors->has('level') ? ' is-invalid' : '' }}"
                  name="level" id="level" aria-label="Default select example" required onchange="namafaktor()">
                  <option @if(old("level")=='' ) selected @endif value='' disabled>Pilih Level Faktor</option>
                  <option @if(old("level")=='1' ) selected @endif value='1'>Level 1
                  </option>
                  <option @if(old("level")=='2' ) selected @endif value='2'>Level 2
                  </option>
                  <option @if(old("level")=='3' ) selected @endif value='3'>Level 3
                  </option>
                  <option @if(old("level")=='4' ) selected @endif value='4'>Level 4
                  </option>
                  <option @if(old("level")=='5' ) selected @endif value='5'>Level 5
                  </option>
                  <option @if(old("level")=='6' ) selected @endif value='6'>Level 6
                  </option>
                  <option @if(old("level")=='7' ) selected @endif value='7'>Level 7
                  </option>
                  <option @if(old("level")=='8' ) selected @endif value='8'>Level 8
                  </option>
                  <option @if(old("level")=='9' ) selected @endif value='9'>Level 9
                  </option>
                  <option @if(old("level")=='10' ) selected @endif value='10'>Level 10
                  </option>
                </select>

                @if ($errors->has('level'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('level') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('nilai') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="nilai">{{ __('Nilai Faktor') }}</label>
                <input type="number" name="nilai" id="nilai"
                  class="form-control form-control-alternative{{ $errors->has('nilai') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Nilai') }}" value="{{ old('nilai') }}" required>

                @if ($errors->has('nilai'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nilai') }}</strong>
                </span>
                @endif
              </div>

              <select
                class="form-select form-control form-control-alternative{{ $errors->has('jenis_jabatan') ? ' is-invalid' : '' }}"
                name="jenis_jabatan" id="jenis_jabatan" aria-label="Default select example" required hidden>
                <option selected value="9 Faktor">Faktor 9 - Jabatan
                  Pelaksana dan Fungsional</option>

              </select>

              @if ($errors->has('jenis_jabatan'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('jenis_jabatan') }}</strong>
              </span>
              @endif
              <div class="form-group{{ $errors->has('indikator') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="indikator">{{ __('Indikator Faktor') }}</label>
                <textarea name="indikator" id="indikator" cols="30" rows="10"
                  class="form-control form-control-alternative{{ $errors->has('indikator') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Indikator Faktor') }}" value="{{ old('indikator') }}"
                  required>{{ old('indikator') }}</textarea>
                @if ($errors->has('indikator'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('indikator') }}</strong>
                </span>
                @endif
              </div>

            </div>


            <div class="text-center">
              <button type="submit" class="btn btn-success mt-4">{{ __('Simpan') }}</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    function namafaktor() {

      var tingkat = document.getElementById("tingkat").value;
      var level = document.getElementById("level").value;
      document.getElementById("nama_faktor").value = tingkat + '-' + level;
    };
    $(document).ready(function() {

    });
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush