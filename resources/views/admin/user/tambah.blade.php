@extends('layouts.app', ['title' => __('Tambah User Account')])

@section('content')
@include('admin.header', ['halaman' => __('Tambah User Account')])
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
            <h3 class="text-center ">{{ __('Tambah User Account') }}</h3>
          </div>
          @if ($errors->any())
          <div class="alert alert-danger text-center alert-dismissible fade show my-2" role="alert">
            @foreach ($errors->all() as $error)
            <strong>{{ $error }}</strong><br>
            @endforeach
          </div>
          @endif
          @if (session('success'))
          <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @if (session('Errors'))
          <div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
            {{ session('Errors') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>

        <div class="card-body">
          <form method="post" action="/insert-user" autocomplete="off">

            @csrf

            <h4 class="heading-small text-muted mb-4">{{ __('Informasi User Account') }}</h4>

            <div class="pl-lg-4">
              <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="input-name">{{ __('Nama') }}</label>
                <input type="text" name="name" id="name"
                  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Nama') }}" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email"
                  class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Email') }}" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="level">{{ __('Password') }}</label>
                <input type="password" name="password" id="password"
                  class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Password') }}" value="{{ old('password') }}" required autofocus>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="role">{{ __('Role') }}</label>
                <select
                  class="tingkat form-select form-control form-control-alternative{{ $errors->has('role') ? ' is-invalid' : '' }}"
                  name="role" id="role" aria-label="Default select example" required onchange="hakakses()">
                  <option @if(old("role")=='' ) selected @endif value='' disabled>Pilih Tingkat Role</option>
                  @if(auth()->user()->role =='superadmin')
                  <option @if(old("role")=='superadmin' ) selected @endif value='superadmin'>Super Administrator
                  </option>
                  <option @if(old("role")=='admin' ) selected @endif value='admin'>Administrator
                  </option>

                  @endif
                  <option @if(old("role")=='pimpinan' ) selected @endif value='pimpinan'>Akun Pimpinan
                  </option>
                  <option @if(old("role")=='bkd' ) selected @endif value='bkd'>Akun BKD
                  </option>
                  <option @if(old("role")=='user' ) selected @endif value='user'>User Account
                  </option>
                </select>

                @if ($errors->has('role'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('role') }}</strong>
                </span>
                @endif
              </div>


              <div id="divakses" class="form-group{{ $errors->has('hak_akses') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="hak_akses">{{ __('Hak Akses Akun') }}</label>
                <select
                  class="tingkat form-select form-control form-control-alternative{{ $errors->has('hak_akses') ? ' is-invalid' : '' }}"
                  name="hak_akses" id="hak_akses" aria-label="Default select example">
                  <option @if(old("hak_akses")=='' ) selected @endif value='' disabled>Pilih Hak Akses OPD</option>
                  {{ $opd = daftardinasselect(); }}
                  @foreach ($opd as $index)
                  <option @if(old("hak_akses")==$index->id ) selected @endif value= {{ $index->id
                    }}>{{$index->nama_dinas}}
                    @endforeach

                </select>

                @if ($errors->has('hak_akses'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('hak_akses') }}</strong>
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
    function hakakses() {
 var role = document.getElementById("role").value
      if (role == 'user'){
        document.getElementById("divakses").style.display = "block";
      }else{
        document.getElementById("hak_akses").value = ''
        document.getElementById("divakses").style.display = "none";
      };
    };
    $(document).ready(function() {
      // document.getElementById("divakses").style.display = "none";
      hakakses();
    });
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush
