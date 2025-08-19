@extends('layouts.app', ['title' => __('Tambah Jabatan '.request('jenis_jabatan'))])

@section('content')
@include('admin.header', ['halaman' => __('Tambah Jabatan '.request('jenis_jabatan'))])
<div class="container-fluid mt--7">
  <div class="row justify-content-center">
    <div class="col-xl-8 order-xl-1 mb-3">
      {{-- Informasi Jabatan --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="col-xl-12 order-xl-1 mb-3">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">

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
            <div class="ml-4">
              <h3 class="text-center">{{ __('A. Informasi Jabatan') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="post" action="jabatan" autocomplete="off">
            @csrf
            <h4 class="heading-small text-muted mb-4">{{ __('A. Informasi Jabatan') }}</h4>
            <div class="pl-lg-4">
              <div class="form-group{{ $errors->has('nama_jabatan') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="nama_jabatan">{{ __('Nama Jabatan') }}</label>
                <input type="text" name="nama_jabatan" id="nama_jabatan"
                  class="form-control form-control-{{ $errors->has('nama_jabatan') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Nama Jabatan') }}" value="{{ old('nama_jabatan') }}" required autofocus>

                @if ($errors->has('nama_jabatan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nama_jabatan') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('nama_unit') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="nama_unit">{{ __('Nama Unit') }}</label>
                <input type="text" name="nama_unit" id="nama_unit"
                  class="form-control form-control-{{ $errors->has('nama_unit') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Nama Unit') }}" value="{{ old('nama_unit') }}" required autofocus>

                @if ($errors->has('nama_unit'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nama_unit') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('jenis_jabatan') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="nama_unit">{{ __('Jenis Jabatan') }}</label>
                <select
                  class="form-select form-control- form-control{{ $errors->has('jenis_jabatan') ? ' is-invalid' : '' }}"
                  name="jenis_jabatan" id="jenis_jabatan" aria-label="Default select example" required readonly>

                  <option @if(old("jenis_jabatan",request('jenis_jabatan'))=='Struktural' ) selected @endif
                    value='Struktural'>Struktural
                  </option>
                  <option @if(old("jenis_jabatan",request('jenis_jabatan'))=='Fungsional' ) selected @endif
                    value='Fungsional'>Fungsional
                  </option>
                  <option @if(old("jenis_jabatan",request('jenis_jabatan'))=='Pelaksana' ) selected @endif
                    value='Pelaksana'>Pelaksana
                  </option>
                </select>
                @if ($errors->has('nama_unit'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nama_unit') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('ikhtisar') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="ikhtisar">{{ __('Ikhtisar') }}</label>
                <textarea name="ikhtisar" id="ikhtisar" cols="30" rows="10"
                  class="form-control form-control-{{ $errors->has('ikhtisar') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Ikhtisar') }}" value="{{ old('ikhtisar') }}"
                  required>{{ old('ikhtisar') }}</textarea>
                @if ($errors->has('ikhtisar'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('ikhtisar') }}</strong>
                </span>
                @endif
              </div>
            </div>
        </div>
      </div>
      {{-- Kualifikasi Jabatan --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="ml-4">
              <h3 class="text-center">{{ __('B. Kualifikasi Jabatan') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('B. Kualifikasi Jabatan') }}</h4>
          <div class="pl-lg-4">
            <div class="form-group{{ $errors->has('pdd_formal') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="pdd_formal">{{ __('Pendidikan Formal') }}</label>
              <input type="text" name="pdd_formal" id="pdd_formal"
                class="form-control form-control-{{ $errors->has('pdd_formal') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Pendidikan Formal') }}" value="{{ old('pdd_formal') }}" required autofocus>

              @if ($errors->has('pdd_formal'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('pdd_formal') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('pdd_jurusan') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="pdd_jurusan">{{ __('Pendidikan Jurusan') }}</label>
              <textarea name="pdd_jurusan" id="pdd_jurusan" cols="30" rows="10"
                class="form-control form-control-{{ $errors->has('pdd_jurusan') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Masukkan Pendidikan Jurusan') }}" value="{{ old('pdd_jurusan') }}"
                required>{{ old('pdd_jurusan') }}</textarea>
              @if ($errors->has('pdd_jurusan'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('pdd_jurusan') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('pelatihan_struktural') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="pelatihan_struktural">{{ __('Pelatihan Struktural')
                }}</label>
              <input type="text" name="pelatihan_struktural" id="pelatihan_struktural"
                class="form-control form-control-{{ $errors->has('pelatihan_struktural') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Jika tidak ada ketik " Tidak Dipersyaratkan"') }}"
                value="{{ old('pelatihan_struktural','Tidak Dipersyaratkan') }}" required autofocus>

              @if ($errors->has('pelatihan_struktural'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('pelatihan_struktural') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('pelatihan_fungsional') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="pelatihan_fungsional">{{ __('Pelatihan Fungsional')
                }}</label>
              <input type="text" name="pelatihan_fungsional" id="pelatihan_fungsional"
                class="form-control form-control-{{ $errors->has('pelatihan_fungsional') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Jika tidak ada ketik " Tidak Dipersyaratkan"') }}"
                value="{{ old('pelatihan_fungsional','Tidak Dipersyaratkan') }}" required autofocus>

              @if ($errors->has('pelatihan_fungsional'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('pelatihan_fungsional') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('pelatihan_teknis') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="pelatihan_teknis">{{ __('Pelatihan Teknis')
                }}</label>
              <input type="text" name="pelatihan_teknis" id="pelatihan_teknis"
                class="form-control form-control-{{ $errors->has('pelatihan_teknis') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Jika tidak ada ketik " Tidak Dipersyaratkan"') }}"
                value="{{ old('pelatihan_teknis','Tidak Dipersyaratkan') }}" required autofocus>

              @if ($errors->has('pelatihan_teknis'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('pelatihan_teknis') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('pengalaman_kerja') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="pengalaman_kerja">{{ __('Pengalaman Kerja') }}</label>
              <textarea name="pengalaman_kerja" id="pengalaman_kerja" cols="30" rows="10"
                class="form-control form-control-{{ $errors->has('pengalaman_kerja') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Masukkan Ikhtisar') }}" value="{{ old('pengalaman_kerja') }}"
                required>{{ old('pengalaman_kerja') }}</textarea>
              @if ($errors->has('pengalaman_kerja'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('pengalaman_kerja') }}</strong>
              </span>
              @endif
            </div>
          </div>

        </div>
      </div>
      {{-- Tugas Pokok Jabatan --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="ml-4">
              <h3 class="text-center">{{ __('C. Tugas Pokok') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('C. Tugas Pokok') }}</h4>
          <div class="pl-lg-2">
            <div class="form-group{{ $errors->has('ut1') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut1">{{ __('Uraian Tugas ke-1')}}</label>
                  <textarea name="uraian_tugas[]" id="ut1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.0') }}"
                    required>{{ old('uraian_tugas.0') }}</textarea>
                  @if ($errors->has('ut1'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut1') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="ut1">{{ __('Hasil Kerja ke-1')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk1"
                    class="form-control form-control-{{ $errors->has('hk1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.0') }}" required autofocus>

                  @if ($errors->has('hk1'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk1') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut2') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut2">{{ __('Uraian Tugas ke-2')}}</label>
                  <textarea name="uraian_tugas[]" id="ut2" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.1') }}"
                    required>{{ old('uraian_tugas.1') }}</textarea>
                  @if ($errors->has('ut2'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut2') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk2">{{ __('Hasil Kerja ke-2')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk2"
                    class="form-control form-control-{{ $errors->has('hk2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.1') }}" required autofocus>

                  @if ($errors->has('hk2'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk2') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut3') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut3">{{ __('Uraian Tugas ke-3')}}</label>
                  <textarea name="uraian_tugas[]" id="ut3" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut3') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.2') }}"
                    required>{{ old('uraian_tugas.2') }}</textarea>
                  @if ($errors->has('ut3'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut3') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk3">{{ __('Hasil Kerja ke-3')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk3"
                    class="form-control form-control-{{ $errors->has('hk3') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.2') }}" required autofocus>

                  @if ($errors->has('hk3'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk3') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut4') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut4">{{ __('Uraian Tugas ke-4')}}</label>
                  <textarea name="uraian_tugas[]" id="ut4" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut4') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.3') }}"
                    required>{{ old('uraian_tugas.3') }}</textarea>
                  @if ($errors->has('ut4'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut4') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk4">{{ __('Hasil Kerja ke-4')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk4"
                    class="form-control form-control-{{ $errors->has('hk4') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.3') }}" required autofocus>

                  @if ($errors->has('hk4'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk4') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut5') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut5">{{ __('Uraian Tugas ke-5')}}</label>
                  <textarea name="uraian_tugas[]" id="ut5" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut5') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.4') }}"
                    required>{{ old('uraian_tugas.4') }}</textarea>
                  @if ($errors->has('ut5'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut5') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk5">{{ __('Hasil Kerja ke-5')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk5"
                    class="form-control form-control-{{ $errors->has('hk5') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.4') }}" required autofocus>

                  @if ($errors->has('hk5'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk5') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut6') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut6">{{ __('Uraian Tugas ke-6')}}</label>
                  <textarea name="uraian_tugas[]" id="ut6" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut6') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.5') }}"
                    required>{{ old('uraian_tugas.5') }}</textarea>
                  @if ($errors->has('ut6'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut6') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk6">{{ __('Hasil Kerja ke-6')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk6"
                    class="form-control form-control-{{ $errors->has('hk6') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.5') }}" required autofocus>

                  @if ($errors->has('hk6'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk6') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut7') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut7">{{ __('Uraian Tugas ke-7')}}</label>
                  <textarea name="uraian_tugas[]" id="ut7" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut7') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.6') }}"
                    required>{{ old('uraian_tugas.6') }}</textarea>
                  @if ($errors->has('ut7'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut7') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk7">{{ __('Hasil Kerja ke-7')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk7"
                    class="form-control form-control-{{ $errors->has('hk7') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.6') }}" required autofocus>

                  @if ($errors->has('hk7'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk7') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut8') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut8">{{ __('Uraian Tugas ke-8')}}</label>
                  <textarea name="uraian_tugas[]" id="ut8" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut8') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.7') }}"
                    required>{{ old('uraian_tugas.7') }}</textarea>
                  @if ($errors->has('ut8'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut8') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk8">{{ __('Hasil Kerja ke-8')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk8"
                    class="form-control form-control-{{ $errors->has('hk8') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.7') }}" required autofocus>

                  @if ($errors->has('hk8'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk8') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut9') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut9">{{ __('Uraian Tugas ke-9')}}</label>
                  <textarea name="uraian_tugas[]" id="ut9" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut9') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.8') }}"
                    required>{{ old('uraian_tugas.8') }}</textarea>
                  @if ($errors->has('ut9'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut9') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk9">{{ __('Hasil Kerja ke-9')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk9"
                    class="form-control form-control-{{ $errors->has('hk9') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.8') }}" required autofocus>

                  @if ($errors->has('hk9'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk9') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('ut10') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="ut10">{{ __('Uraian Tugas ke-10')}}</label>
                  <textarea name="uraian_tugas[]" id="ut10" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('ut10') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Uraian Tugas') }}" value="{{ old('uraian_tugas.9') }}"
                    required>{{ old('uraian_tugas.9') }}</textarea>
                  @if ($errors->has('ut10'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ut10') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="hk10">{{ __('Hasil Kerja ke-10')}}</label>
                  <input type="text" name="hasil_kerja[]" id="hk10"
                    class="form-control form-control-{{ $errors->has('hk10') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Hasil Kerja') }}" value="{{ old('hasil_kerja.9') }}" required autofocus>

                  @if ($errors->has('hk10'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hk10') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      {{-- Hasil Kerja --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="ml-4">
              <h3 class="text-center">{{ __('D. Hasil Kerja') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('D. Hasil Kerja') }}</h4>
          <div class="pl-lg-4">
            <div class="form-group{{ $errors->has('hasil_kerja_jabatan') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="hasil_kerja_jabatan">{{ __('Hasil Kerja') }}</label>
              <textarea name="hasil_kerja_jabatan" id="hasil_kerja_jabatan" cols="30" rows="10"
                class="form-control form-control-{{ $errors->has('hasil_kerja_jabatan') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Masukkan Hasil Kerja') }}" value="{{ old('hasil_kerja_jabatan') }}"
                required>{{ old('hasil_kerja_jabatan') }}</textarea>
              @if ($errors->has('hasil_kerja_jabatan'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('hasil_kerja_jabatan') }}</strong>
              </span>
              @endif
            </div>
          </div>

        </div>
      </div>
      {{-- Bahan Kerja --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="ml-4">
              <h3 class="text-center">{{ __('E. Bahan Kerja') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('E. Bahan Kerja') }}</h4>
          <div class="pl-lg-2">
            <div class="form-group{{ $errors->has('bahan1') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan1">{{ __('Bahan Kerja ke-1')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.0') }}"
                    required>{{ old('bahan_kerja.0') }}</textarea>

                  @if ($errors->has('bahan1'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan1') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_1">{{ __('Penggunaan Dalam Tugas
                    ke-1')}}</label>
                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.0') }}"
                    required>{{ old('penggunaan_bahan.0') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_1'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_1') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan2') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan2">{{ __('Bahan Kerja ke-2')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan2" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.1') }}"
                    required>{{ old('bahan_kerja.1') }}</textarea>
                  @if ($errors->has('bahan2'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan2') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_2">{{ __('Penggunaan Dalam Tugas
                    ke-2')}}</label>

                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.1') }}"
                    required>{{ old('penggunaan_bahan.1') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_2'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_2') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan3') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan3">{{ __('Bahan Kerja ke-3')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan3" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan3') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.2') }}"
                    required>{{ old('bahan_kerja.2') }}</textarea>
                  @if ($errors->has('bahan3'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan3') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_3">{{ __('Penggunaan Dalam Tugas
                    ke-3')}}</label>

                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.2') }}"
                    required>{{ old('penggunaan_bahan.2') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_3'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_3') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan4') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan4">{{ __('Bahan Kerja ke-4')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan4" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan4') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.3') }}"
                    required>{{ old('bahan_kerja.3') }}</textarea>
                  @if ($errors->has('bahan4'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan4') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_4">{{ __('Penggunaan Dalam Tugas
                    ke-4')}}</label>

                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.3') }}"
                    required>{{ old('penggunaan_bahan.3') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_4'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_4') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan5') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan5">{{ __('Bahan Kerja ke-5')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan5" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan5') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.4') }}"
                    required>{{ old('bahan_kerja.4') }}</textarea>
                  @if ($errors->has('bahan5'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan5') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_5">{{ __('Penggunaan Dalam Tugas
                    ke-5')}}</label>
                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.4') }}"
                    required>{{ old('penggunaan_bahan.4') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_5'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_5') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan6') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan6">{{ __('Bahan Kerja ke-6')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan6" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan6') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.5') }}"
                    required>{{ old('bahan_kerja.5') }}</textarea>
                  @if ($errors->has('bahan6'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan6') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_6">{{ __('Penggunaan Dalam Tugas
                    ke-6')}}</label>
                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.5') }}"
                    required>{{ old('penggunaan_bahan.5') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_6'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_6') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan7') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan7">{{ __('Bahan Kerja ke-7')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan7" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan7') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.6') }}"
                    required>{{ old('bahan_kerja.6') }}</textarea>
                  @if ($errors->has('bahan7'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan7') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_7">{{ __('Penggunaan Dalam Tugas
                    ke-7')}}</label>
                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.6') }}"
                    required>{{ old('penggunaan_bahan.6') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_7'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_7') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan8') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan8">{{ __('Bahan Kerja ke-8')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan8" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan8') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.7') }}"
                    required>{{ old('bahan_kerja.7') }}</textarea>
                  @if ($errors->has('bahan8'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan8') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_8">{{ __('Penggunaan Dalam Tugas
                    ke-8')}}</label>

                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.7') }}"
                    required>{{ old('penggunaan_bahan.7') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_8'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_8') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan9') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan9">{{ __('Bahan Kerja ke-9')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan9" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan9') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.8') }}"
                    required>{{ old('bahan_kerja.8') }}</textarea>
                  @if ($errors->has('bahan9'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan9') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_9">{{ __('Penggunaan Dalam Tugas
                    ke-9')}}</label>
                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.8') }}"
                    required>{{ old('penggunaan_bahan.8') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_9'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_9') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('bahan10') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="bahan10">{{ __('Bahan Kerja ke-10')}}</label>
                  <textarea name="bahan_kerja[]" id="bahan10" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('bahan10') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Bahan Kerja') }}" value="{{ old('bahan_kerja.9') }}"
                    required>{{ old('bahan_kerja.9') }}</textarea>
                  @if ($errors->has('bahan10'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bahan10') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan_bahan_10">{{ __('Penggunaan Dalam Tugas
                    ke-10')}}</label>

                  <textarea name="penggunaan_bahan[]" id="penggunaan_bahan_1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan_bahan_1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan_bahan.9') }}"
                    required>{{ old('penggunaan_bahan.9') }}</textarea>

                  @if ($errors->has('penggunaan_bahan_10'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan_bahan_10') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      {{-- Perangkat Kerja --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="ml-4">
              <h3 class="text-center">{{ __('F. Perangkat Kerja') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('F. Perangkat Kerja') }}</h4>
          <div class="pl-lg-2">
            <div class="form-group{{ $errors->has('perangkat_kerja1') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja1">{{ __('Perangkat Kerja ke-1')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.0') }}"
                    required>{{ old('perangkat_kerja.0') }}</textarea>
                  @if ($errors->has('perangkat_kerja1'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja1') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan1">{{ __('Penggunaan Dalam Tugas
                    ke-1')}}</label>

                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.0') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.0') }}"
                    required>{{ old('penggunaan.0') }}</textarea>

                  @if ($errors->has('penggunaan1'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan1') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja2') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja2">{{ __('Perangkat Kerja ke-2')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja2" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.1') }}"
                    required>{{ old('perangkat_kerja.1') }}</textarea>
                  @if ($errors->has('perangkat_kerja2'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja2') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan2">{{ __('Penggunaan Dalam Tugas
                    ke-2')}}</label>

                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.1') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.1') }}"
                    required>{{ old('penggunaan.1') }}</textarea>

                  @if ($errors->has('penggunaan2'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan2') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja3') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja3">{{ __('Perangkat Kerja ke-3')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja3" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja3') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.2') }}"
                    required>{{ old('perangkat_kerja.2') }}</textarea>
                  @if ($errors->has('perangkat_kerja3'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja3') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan3">{{ __('Penggunaan Dalam Tugas
                    ke-3')}}</label>

                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.2') }}"
                    required>{{ old('penggunaan.2') }}</textarea>

                  @if ($errors->has('penggunaan3'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan3') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja4') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja4">{{ __('Perangkat Kerja ke-4')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja4" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja4') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.3') }}"
                    required>{{ old('perangkat_kerja.3') }}</textarea>
                  @if ($errors->has('perangkat_kerja4'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja4') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan4">{{ __('Penggunaan Dalam Tugas
                    ke-4')}}</label>
                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.3') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.3') }}"
                    required>{{ old('penggunaan.3') }}</textarea>

                  @if ($errors->has('penggunaan4'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan4') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja5') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja5">{{ __('Perangkat Kerja ke-5')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja5" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja5') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.4') }}"
                    required>{{ old('perangkat_kerja.4') }}</textarea>
                  @if ($errors->has('perangkat_kerja5'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja5') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan5">{{ __('Penggunaan Dalam Tugas
                    ke-5')}}</label>
                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.4') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.4') }}"
                    required>{{ old('penggunaan.4') }}</textarea>

                  @if ($errors->has('penggunaan5'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan5') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja6') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja6">{{ __('Perangkat Kerja ke-6')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja6" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja6') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.5') }}"
                    required>{{ old('perangkat_kerja.5') }}</textarea>
                  @if ($errors->has('perangkat_kerja6'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja6') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan6">{{ __('Penggunaan Dalam Tugas
                    ke-6')}}</label>
                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.5') }}"
                    required>{{ old('penggunaan.5') }}</textarea>

                  @if ($errors->has('penggunaan6'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan6') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja7') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja7">{{ __('Perangkat Kerja ke-7')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja7" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja7') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.6') }}"
                    required>{{ old('perangkat_kerja.6') }}</textarea>
                  @if ($errors->has('perangkat_kerja7'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja7') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan7">{{ __('Penggunaan Dalam Tugas
                    ke-7')}}</label>
                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.6') }}"
                    required>{{ old('penggunaan.6') }}</textarea>

                  @if ($errors->has('penggunaan7'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan7') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja8') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja8">{{ __('Perangkat Kerja ke-8')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja8" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja8') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.7') }}"
                    required>{{ old('perangkat_kerja.7') }}</textarea>
                  @if ($errors->has('perangkat_kerja8'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja8') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan8">{{ __('Penggunaan Dalam Tugas
                    ke-8')}}</label>
                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.7') }}"
                    required>{{ old('penggunaan.7') }}</textarea>

                  @if ($errors->has('penggunaan8'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan8') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja9') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja9">{{ __('Perangkat Kerja ke-9')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja9" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja9') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.8') }}"
                    required>{{ old('perangkat_kerja.8') }}</textarea>
                  @if ($errors->has('perangkat_kerja9'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja9') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan9">{{ __('Penggunaan Dalam Tugas
                    ke-9')}}</label>
                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.8') }}"
                    required>{{ old('penggunaan.8') }}</textarea>

                  @if ($errors->has('penggunaan9'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan9') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group{{ $errors->has('perangkat_kerja10') ? ' has-danger' : '' }}">
              <div class="row align-items-center">
                <div class="col-8">
                  <label class="form-control-label" for="perangkat_kerja10">{{ __('Perangkat Kerja ke-10')}}</label>
                  <textarea name="perangkat_kerja[]" id="perangkat_kerja10" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('perangkat_kerja10') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Perangkat Kerja') }}" value="{{ old('perangkat_kerja.9')  }}"
                    required>{{ old('perangkat_kerja.9') }}</textarea>
                  @if ($errors->has('perangkat_kerja10'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perangkat_kerja10') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="col-4">
                  <label class="form-control-label" for="penggunaan10">{{ __('Penggunaan Dalam Tugas
                    ke-10')}}</label>
                  <textarea name="penggunaan[]" id="penggunaan1" cols="30" rows="3"
                    class="form-control form-control-{{ $errors->has('penggunaan.2') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Penggunaan Dalam Tugas') }}" value="{{ old('penggunaan.9') }}"
                    required>{{ old('penggunaan.9') }}</textarea>

                  @if ($errors->has('penggunaan10'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('penggunaan10') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      {{-- Tanggung Jawab & wewenang Jabatan --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="ml-4">
              <h3 class="text-center">{{ __('G. Tanggung Jawab & Wewenang') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('G. Tanggung Jawab & Wewenang') }}</h4>
          <div class="pl-lg-4">

            <div class="form-group{{ $errors->has('tanggung_jawab') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="tanggung_jawab">{{ __('Tanggung Jawab') }}</label>
              <textarea name="tanggung_jawab" id="tanggung_jawab" cols="30" rows="10"
                class="form-control form-control-{{ $errors->has('tanggung_jawab') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Tanggung Jawab') }}" value="{{ old('tanggung_jawab') }}"
                required>{{ old('tanggung_jawab') }}</textarea>
              @if ($errors->has('tanggung_jawab'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tanggung_jawab') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('wewenang') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="wewenang">{{ __('Wewenang') }}</label>
              <textarea name="wewenang" id="wewenang" cols="30" rows="10"
                class="form-control form-control-{{ $errors->has('wewenang') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Wewenang') }}" value="{{ old('wewenang') }}"
                required>{{ old('wewenang') }}</textarea>
              @if ($errors->has('wewenang'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('wewenang') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
      {{-- Kondisi Lingkungan Kerja--}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="ml-4">
              <h3 class="text-center">{{ __('H. Kondisi Lingkungan Kerja') }}</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h4 class="heading-small text-muted mb-4">{{ __('H. Kondisi Lingkungan Kerja') }}</h4>
          <div class="pl-lg-4">
            <div class="form-group{{ $errors->has('tempat_kerja') ? ' has-danger' : '' }}">

              <label class="form-control-label" for="tempat_kerja">{{ __('Persentase Tempat Kerja Dalam Ruangan')
                }}</label>
              <div class="input-group mb-4">
                <input type="number" name="tempat_kerja" id="tempat_kerja"
                  class="form-control form-control-{{ $errors->has('tempat_kerja') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Input 0 - 100') }}" value="{{ old('tempat_kerja') }}" required min="0" max="100"
                  maxlength="10" autofocus>
                <div class="input-group-append">
                  <span class="input-group-text">%</span>
                </div>
              </div>
              @if ($errors->has('tempat_kerja'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tempat_kerja') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('suhu') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="suhu">{{ __('Suhu') }}</label>
              <select class="form-select form-control- form-control{{ $errors->has('suhu') ? ' is-invalid' : '' }}"
                name="suhu" id="suhu" aria-label="Default select example" required>
                <option @if(old("suhu")=='' ) selected @endif value='' disabled>Pilih Suhu</option>
                <option @if(old("suhu")=='Dingin' ) selected @endif value='Dingin'>Dingin
                </option>
                <option @if(old("suhu")=='Sedang/Cukup' ) selected @endif value='Sedang/Cukup'>Sedang/Cukup
                </option>
                <option @if(old("suhu")=='Panas' ) selected @endif value='Panas'>Panas
                </option>
                <option @if(old("suhu")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua Kondisi
                </option>
              </select>
              @if ($errors->has('suhu'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('suhu') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('udara') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="udara">{{ __('Udara') }}</label>
              <select class="form-select form-control- form-control{{ $errors->has('udara') ? ' is-invalid' : '' }}"
                name="udara" id="udara" aria-label="Default select example" required>
                <option @if(old("udara")=='' ) selected @endif value='' disabled>Pilih Udara</option>
                <option @if(old("udara")=='Sejuk' ) selected @endif value='Sejuk'>Sejuk
                </option>
                <option @if(old("udara")=='Sedang' ) selected @endif value='Sedang'>Sedang
                </option>
                <option @if(old("udara")=='Kering' ) selected @endif value='Kering'>Kering
                </option>
                <option @if(old("udara")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua Kondisi
                </option>
              </select>
              @if ($errors->has('udara'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('udara') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('keadaan_ruangan') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="keadaan_ruangan">{{ __('Keadaan Ruangan') }}</label>
              <select
                class="form-select form-control- form-control{{ $errors->has('keadaan_ruangan') ? ' is-invalid' : '' }}"
                name="keadaan_ruangan" id="keadaan_ruangan" aria-label="Default select example" required>
                <option @if(old("keadaan_ruangan")=='' ) selected @endif value='' disabled>Pilih Keadaan Ruangan
                </option>
                <option @if(old("keadaan_ruangan")=='Sempit' ) selected @endif value='Sejuk'>Sempit
                </option>
                <option @if(old("keadaan_ruangan")=='Sedang' ) selected @endif value='Sedang'>Sedang
                </option>
                <option @if(old("keadaan_ruangan")=='Luas' ) selected @endif value='Kering'>Luas
                </option>
                <option @if(old("keadaan_ruangan")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua
                  Kondisi
                </option>
              </select>
              @if ($errors->has('keadaan_ruangan'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('keadaan_ruangan') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('letak') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="letak">{{ __('Letak') }}</label>
              <select class="form-select form-control- form-control{{ $errors->has('letak') ? ' is-invalid' : '' }}"
                name="letak" id="letak" aria-label="Default select example" required>
                <option @if(old("letak")=='' ) selected @endif value='' disabled>Pilih Letak
                </option>
                <option @if(old("letak")=='Perdesaan' ) selected @endif value='Perdesaan'>Perdesaan
                </option>
                <option @if(old("letak")=='Perkotaan' ) selected @endif value='Sedang'>Perkotaan
                </option>
                <option @if(old("letak")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua
                  Kondisi
                </option>
              </select>
              @if ($errors->has('letak'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('letak') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('penerangan') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="penerangan">{{ __('Penerangan') }}</label>
              <select
                class="form-select form-control- form-control{{ $errors->has('penerangan') ? ' is-invalid' : '' }}"
                name="penerangan" id="penerangan" aria-label="Default select example" required>
                <option @if(old("penerangan")=='' ) selected @endif value='' disabled>Pilih Penerangan
                </option>
                <option @if(old("penerangan")=='Terang' ) selected @endif value='Terang'>Terang
                </option>
                <option @if(old("penerangan")=='Redup' ) selected @endif value='Redup'>Redup
                </option>
                <option @if(old("penerangan")=='Gelap' ) selected @endif value='Gelap'>Gelap
                </option>
                <option @if(old("penerangan")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua
                  Kondisi
                </option>
              </select>
              @if ($errors->has('penerangan'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('penerangan') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('suara') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="suara">{{ __('Suara') }}</label>
              <select class="form-select form-control- form-control{{ $errors->has('suara') ? ' is-invalid' : '' }}"
                name="suara" id="suara" aria-label="Default select example" required>
                <option @if(old("suara")=='' ) selected @endif value='' disabled>Pilih Suara
                </option>
                <option @if(old("suara")=='Tenang' ) selected @endif value='Tenang'>Tenang
                </option>
                <option @if(old("suara")=='Bising' ) selected @endif value='Bising'>Bising
                </option>
                <option @if(old("suara")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua
                  Kondisi
                </option>
              </select>
              @if ($errors->has('suara'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('suara') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('keadaan_tempat_kerja') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="keadaan_tempat_kerja">{{ __('Keadaan Tempat Kerja') }}</label>
              <select
                class="form-select form-control- form-control{{ $errors->has('keadaan_tempat_kerja') ? ' is-invalid' : '' }}"
                name="keadaan_tempat_kerja" id="keadaan_tempat_kerja" aria-label="Default select example" required>
                <option @if(old("keadaan_tempat_kerja")=='' ) selected @endif value='' disabled>Pilih Keadaan Tempat
                  Kerja
                </option>
                <option @if(old("keadaan_tempat_kerja")=='Bersih dan Rapi' ) selected @endif value='Bersih dan Rapi'>
                  Bersih dan Rapi
                </option>
                <option @if(old("keadaan_tempat_kerja")=='Tidak Teratur' ) selected @endif value='Tidak Teratur'>Tidak
                  Teratur
                </option>
                <option @if(old("keadaan_tempat_kerja")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua
                  Kondisi
                </option>
              </select>
              @if ($errors->has('keadaan_tempat_kerja'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('keadaan_tempat_kerja') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('getaran') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="getaran">{{ __('Getaran') }}</label>
              <select class="form-select form-control- form-control{{ $errors->has('getaran') ? ' is-invalid' : '' }}"
                name="getaran" id="getaran" aria-label="Default select example" required>
                <option @if(old("getaran")=='' ) selected @endif value='' disabled>Pilih Getaran
                </option>
                <option @if(old("getaran")=='Ada' ) selected @endif value='Ada'>Ada
                </option>
                <option @if(old("getaran")=='Tidak ada' ) selected @endif value='Tidak ada'>Tidak ada
                </option>
                <option @if(old("getaran")=='Semua Kondisi' ) selected @endif value='Semua Kondisi'>Semua
                  Kondisi
                </option>
              </select>
              @if ($errors->has('getaran'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('getaran') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
      {{-- Risiko Bahaya --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <h3 class="text-center">{{ __('I. Risiko Bahaya') }}</h3>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('I. Risiko Bahaya') }}</h4>
          <div class="pl-lg-4">
            <div class="form-group{{ $errors->has('fisik') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="fisik">{{ __('Fisik') }}</label>
              <input type="text" name="fisik" id="fisik"
                class="form-control form-control-{{ $errors->has('fisik') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Fisik') }}" value="{{ old('fisik','Tidak ada/rendah') }}" required autofocus>

              @if ($errors->has('fisik'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('fisik') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('mental') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="mental">{{ __('Mental') }}</label>
              <input type="text" name="mental" id="mental"
                class="form-control form-control-{{ $errors->has('mental') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Mental') }}" value="{{ old('mental','Tidak ada/rendah') }}" required autofocus>

              @if ($errors->has('mental'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('mental') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
      {{-- Syarat kerja --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <h3 class="text-center">{{ __('J. Syarat Jabatan') }}</h3>
          </div>
        </div>
        <div class="card-body">

          <h4 class="heading-small text-muted mb-4">{{ __('J. Syarat Jabatan') }}</h4>
          <div class="pl-lg-4">
            <div class="form-group{{ $errors->has('keterampilan') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="keterampilan">{{ __('Keterampilan') }}</label>
              <textarea name="keterampilan" id="keterampilan" cols="30" rows="10"
                class="form-control form-control-{{ $errors->has('keterampilan') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Masukkan Keterampilan') }}" value="{{ old('keterampilan') }}"
                required>{{ old('keterampilan') }}</textarea>
              @if ($errors->has('keterampilan'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('keterampilan') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('bakat') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="bakat">{{ __('Bakat Kerja') }}</label>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('G',
                  old('bakat'))) checked @endif id="bakat1" type="checkbox" value="G">
                <label class="custom-control-label" for="bakat1">- G : Intelegensia / Kemampuan belajar secara
                  umum</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('V',
                  old('bakat'))) checked @endif id="bakat2" type="checkbox" value="V">
                <label class="custom-control-label" for="bakat2">- V : Bakat Verbal / Kemampuan untuk memahami arti
                  kata-kata dan penggunaannya secara tepat dan efektif</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('N',
                  old('bakat'))) checked @endif id="bakat3" type="checkbox" value="N">
                <label class="custom-control-label" for="bakat3">- N : Bakat Numerik / Kemampuan untuk melakukan operasi
                  arithmatik secara tepat dan akurat</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('S',
                  old('bakat'))) checked @endif id="bakat4" type="checkbox" value="S">
                <label class="custom-control-label" for="bakat4">- S : Bakat Pandang Ruang / Kemampuan berpikir secara
                  visual mengenai bentuk-bentuk geometris, untuk memahami gambar-gambar dari benda-benda tiga
                  dimensi</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('P',
                  old('bakat'))) checked @endif id="bakat5" type="checkbox" value="P">
                <label class="custom-control-label" for="bakat5">- P : Bakat Penerapan Bentuk / Kemampuan menyerap
                  perincian-perincian yang berkaitan dalam objek atau dalam gambar atau dalam bahan grafik</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('Q',
                  old('bakat'))) checked @endif id="bakat6" type="checkbox" value="Q">
                <label class="custom-control-label" for="bakat6">- Q : Bakat Ketelitian / Kemampuan menyerap perincian
                  yang berkaitan dalam bahan verbal atau dalam tabel</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('K',
                  old('bakat'))) checked @endif id="bakat7" type="checkbox" value="K">
                <label class="custom-control-label" for="bakat7">- K : Koordinasi Motorik / Kemampuan untuk
                  mengkoordinir mata dan tangan secara cepat dan cermat dalam membuat gerakan yang cepat</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('F',
                  old('bakat'))) checked @endif id="bakat8" type="checkbox" value="F">
                <label class="custom-control-label" for="bakat8">- F : Kecekatan Jari / Kemampuan menggerakkan
                  jari-jemari dengan mudah dan perlu keterampilan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('E',
                  old('bakat'))) checked @endif id="bakat9" type="checkbox" value="E">
                <label class="custom-control-label" for="bakat9">- E : Koordinasi Mata,Tangan, Kaki / Kemampuan
                  menggerakkan tangan dan kaki secara koordinatif satu sama lain sesuai dengan rangsangan
                  penglihatan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('C',
                  old('bakat'))) checked @endif id="bakat10" type="checkbox" value="C">
                <label class="custom-control-label" for="bakat10">- C : Kemampuan Membedakan Warna / Kemampuan memadukan
                  atau membedakan berbagai warna yang asli, yang gemerlapan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="bakat[]" @if(is_array(old('bakat')) && in_array('M',
                  old('bakat'))) checked @endif id="bakat11" type="checkbox" value="M">
                <label class="custom-control-label" for="bakat11">- M : Kecekatan Tangan / Kemampuan menggerakkan tangan
                  dengan mudah dan penuh keterampilan</label>
              </div>
              @if ($errors->has('bakat'))
              <span class="invalid-feedback" role="alert">@if(is_array(old('bakat')) && in_array('G', old('bakat')))
                checked @endif
                <strong>{{ $errors->first('bakat') }}</strong>
              </span>
              @endif
            </div>
            <hr class="my-4" />
            <div class="form-group{{ $errors->has('temperamen') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="temperamen">{{ __('Temperamen Kerja') }}</label>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('D',
                  old('temperamen'))) checked @endif id="temperamen1" type="checkbox" value="D">
                <label class="custom-control-label" for="temperamen1">- D : Kemampuan menyesuaikan diri menerima
                  tanggung jawab untuk kegiatan memimpin, mengendalikan atau merencanakan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('F',
                  old('temperamen'))) checked @endif id="temperamen2" type="checkbox" value="F">
                <label class="custom-control-label" for="temperamen2">- F : Kemampuan menyesuaikan diri dengan kegiatan
                  yang mengandung penafsiran perasaan, gagasan atau fakta dari sudut pandangan pribadi</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('I',
                  old('temperamen'))) checked @endif id="temperamen3" type="checkbox" value="I">
                <label class="custom-control-label" for="temperamen3">- I : Kemampuan menyesuaikan diri untuk pekerjaan
                  - pekerjaan mempengaruhi orang lain dalam pendapat, sikap atau pertimbangan mengenai gagasan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('J',
                  old('temperamen'))) checked @endif id="temperamen4" type="checkbox" value="J">
                <label class="custom-control-label" for="temperamen4">- J : Kemampuan menyesuaikan diri pada kegiatan
                  perbuatan kesimpulan penilaian atau pembuatan peraturan berdasarkan kriteria rangsangan indera atau
                  atas dasar pertimbangan pribadi</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('M',
                  old('temperamen'))) checked @endif id="temperamen5" type="checkbox" value="M">
                <label class="custom-control-label" for="temperamen5">- M : Kemampuan menyesuaikan diri dengan kegiatan
                  pengambilan peraturan, pembuatan, pertimbangan, atau pembuatan peraturan berdasarkan kriteria yang
                  diukur atau yang dapat diuji</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('P',
                  old('temperamen'))) checked @endif id="temperamen6" type="checkbox" value="P">
                <label class="custom-control-label" for="temperamen6">- P : Kemampuan menyesuaikan diri dalam
                  berhubungan dengan orang lain lebih dari hanya penerimaan dan pembuatan instruksi</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('R',
                  old('temperamen'))) checked @endif id="temperamen7" type="checkbox" value="R">
                <label class="custom-control-label" for="temperamen7">- R : Kemampuan menyesuaikan diri dalam
                  kegiatan-kegiatan yang berulang, atau secara terus menerus melakukan kegiatan yang sama, sesuai dengan
                  perangkat prosedur, urutan atau kecepatan yang tertentu</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('S',
                  old('temperamen'))) checked @endif id="temperamen8" type="checkbox" value="S">
                <label class="custom-control-label" for="temperamen8">- S : Kemampuan menyesuaikan diri untuk bekerja
                  dengan ketegangan jiwa jika berhadapan dengan keadaan darurat, kritis, tidak biasa atau bahaya, atau
                  bekerja dengan kecepatan kerja dan perhatian terus menerus merupakan keseluruhan atau sebagian aspek
                  pekerjaan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('T',
                  old('temperamen'))) checked @endif id="temperamen9" type="checkbox" value="T">
                <label class="custom-control-label" for="temperamen9">- T : Kemampuan menyesuaikan diri dengan situasi
                  yang menghendaki pencapaian dengan tepat menurut perangkat batas, toleransi atau standar-standar
                  tertentu</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="temperamen[]" @if(is_array(old('temperamen')) && in_array('V',
                  old('temperamen'))) checked @endif id="temperamen10" type="checkbox" value='V'>
                <label class="custom-control-label" for="temperamen10">- V : Kemampuan menyesuaikan diri untuk
                  melaksanakan berbagai tugas, sering berganti dari tugas yang satu ke tugas yang lainnya yang "berbeda"
                  sifatnya, tanpa kehilangan efisiensi atau ketenangan diri</label>
              </div>
              @if ($errors->has('temperamen'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('temperamen') }}</strong>
              </span>
              @endif
            </div>
            <hr class="my-4" />
            <div class="form-group{{ $errors->has('minat') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="minat">{{ __('Minat Kerja') }}</label>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="minat[]" @if(is_array(old('minat')) &&
                  in_array('Investigatif', old('minat'))) checked @endif id="minat1" type="checkbox"
                  value="Investigatif">
                <label class="custom-control-label" for="minat1">- <strong>Investigatif</strong> = Kemampuan analisis
                  ilmiah /
                  ilmiah</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="minat[]" @if(is_array(old('minat')) && in_array('Artistik',
                  old('minat'))) checked @endif id="minat2" type="checkbox" value="Artistik">
                <label class="custom-control-label" for="minat2">- <strong>Artistik</strong> = Melakukan pemikiran
                  kreatif</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="minat[]" @if(is_array(old('minat')) && in_array('Sosial',
                  old('minat'))) checked @endif id="minat3" type="checkbox" value="Sosial">
                <label class="custom-control-label" for="minat3">- <strong>Sosial</strong> = Menjalin hubungan dengan
                  orang lain,
                  melakukan pelayanan kepada masyarakat</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="minat[]" @if(is_array(old('minat')) &&
                  in_array('Enterpreneurial', old('minat'))) checked @endif id="minat4" type="checkbox"
                  value="Enterpreneurial">
                <label class="custom-control-label" for="minat4">- <strong>Enterpreneurial</strong> = Pengambilan
                  resiko, pengambilan
                  keputusan dan negosiasi</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="minat[]" @if(is_array(old('minat')) &&
                  in_array('Konvensional', old('minat'))) checked @endif id="minat5" type="checkbox"
                  value="Konvensional">
                <label class="custom-control-label" for="minat5">- <strong>Konvensional</strong> = Ketaatan terhadap
                  prosedur /
                  aturan</label>
              </div>

              @if ($errors->has('minat'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('minat') }}</strong>
              </span>
              @endif
            </div>
            <hr class="my-4" />
            <div class="form-group{{ $errors->has('upaya_fisik') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="upaya_fisik">{{ __('Upaya Fisik Kerja') }}</label>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('Berdiri', old('upaya_fisik'))) checked @endif id="upaya_fisik1" type="checkbox"
                  value="Berdiri">
                <label class="custom-control-label" for="upaya_fisik1">- <strong>Berdiri</strong> : Berada di suatu
                  tempat dalam posisi tegak ditempat tanpa pindah ke tempat lain</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('berjalan', old('upaya_fisik'))) checked @endif id="upaya_fisik2" type="checkbox"
                  value="berjalan">
                <label class="custom-control-label" for="upaya_fisik2">- <strong>Berjalan</strong> : Bergerak dengan
                  jalan kaki</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('duduk', old('upaya_fisik'))) checked @endif id="upaya_fisik3" type="checkbox" value="duduk">
                <label class="custom-control-label" for="upaya_fisik3">- <strong>Duduk</strong> : Berada dalam suatu
                  tempat dalam posisi
                  duduk biasa</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('mengangkat', old('upaya_fisik'))) checked @endif id="upaya_fisik4" type="checkbox"
                  value="mengangkat">
                <label class="custom-control-label" for="upaya_fisik4">- <strong>Mengangkat</strong> : Menaikkan atau
                  menurunkan benda di
                  satu tingkat ke tingkat lain (termasuk menarik ke atas)</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('membawa', old('upaya_fisik'))) checked @endif id="upaya_fisik5" type="checkbox"
                  value="membawa">
                <label class="custom-control-label" for="upaya_fisik5">- <strong>Membawa</strong> : Memindahkan benda,
                  umumnya dengan
                  menggunakan tangan, lengan atau bahu</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('mendorong', old('upaya_fisik'))) checked @endif id="upaya_fisik6" type="checkbox"
                  value="mendorong">
                <label class="custom-control-label" for="upaya_fisik6">- <strong>Mendorong</strong> : Menggunakan tenaga
                  untuk
                  memindahkan benda menjauhi badan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('menarik', old('upaya_fisik'))) checked @endif id="upaya_fisik7" type="checkbox"
                  value="menarik">
                <label class="custom-control-label" for="upaya_fisik7">- <strong>Menarik</strong> : Menggunakan tenaga
                  untuk memindahkan
                  suatu benda ke arah badan (termasuk menyentak atau merenggut)</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('memanjat', old('upaya_fisik'))) checked @endif id="upaya_fisik8" type="checkbox"
                  value="memanjat">
                <label class="custom-control-label" for="upaya_fisik8">- <strong>Memanjat</strong> : Naik atau turun
                  tangga, tiang,
                  lorong dan Iain-Iain dengan menggunakan kaki, tangan, dan kaki</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('menyimpan imbangan / mengatur imbangan', old('upaya_fisik'))) checked @endif
                  id="upaya_fisik9" type="checkbox" value="menyimpan imbangan / mengatur imbangan">
                <label class="custom-control-label" for="upaya_fisik9">- <strong>Menyimpan imbangan / mengatur
                    imbangan</strong> : Agar
                  tidak jatuh badan waktu berjalan, berdiri, membungkuk, atau beiiari di atas tempat yang agak sempit,
                  licin dan tinggi tanpa alat pegangan, atau mengatur imbangan pada waktu melakukan olahraga
                  senam</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('menunduk', old('upaya_fisik'))) checked @endif id="upaya_fisik10" type="checkbox"
                  value='menunduk'>
                <label class="custom-control-label" for="upaya_fisik10">- <strong>Menunduk</strong> : Melengkungkan
                  tubuh dengan cara
                  melekukkan tulang punggung dan kaki</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('berlutut', old('upaya_fisik'))) checked @endif id="upaya_fisik11" type="checkbox"
                  value='berlutut'>
                <label class="custom-control-label" for="upaya_fisik11">- <strong>Berlutut</strong> : Melengkungkan paha
                  kaki pada lutut dan berdiam di suatu tempat dengan tubuh diatas lutut</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('membungkuk', old('upaya_fisik'))) checked @endif id="upaya_fisik12" type="checkbox"
                  value='membungkuk'>
                <label class="custom-control-label" for="upaya_fisik12">- <strong>Membungkuk</strong> : Melengkungkan
                  tubuh dengan cara melengkungkan tulang punggung sampai kira-kira sejajar dengan pinggang</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('merangkak', old('upaya_fisik'))) checked @endif id="upaya_fisik13" type="checkbox"
                  value='merangkak'>
                <label class="custom-control-label" for="upaya_fisik13">- <strong>Merangkak</strong> : Bergerak dengan
                  menggunakan tangan dan lutut atau kaki dan tangan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('menjangkau', old('upaya_fisik'))) checked @endif id="upaya_fisik14" type="checkbox"
                  value='menjangkau'>
                <label class="custom-control-label" for="upaya_fisik14">- <strong>Menjangkau</strong> :
                  Mengulurkan tangan dan lengan ke jurusan tertentu</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('memegang', old('upaya_fisik'))) checked @endif id="upaya_fisik15" type="checkbox"
                  value='memegang'>
                <label class="custom-control-label" for="upaya_fisik15">- <strong>Memegang</strong> : Dengan satu atau
                  dua tangan mengukur, menggenggam, memutar dan lain sebagainya</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('bekerja dengan jari', old('upaya_fisik'))) checked @endif id="upaya_fisik16" type="checkbox"
                  value='bekerja dengan jari'>
                <label class="custom-control-label" for="upaya_fisik16">- <strong>Bekerja Dengan Jari</strong> :
                  Memungut, menjepit, menekan dan lain sebagainya dengan menggunakan jari (berbeda dengan "memegang"
                  yang terutama menggunakan seluruh bagian tangan)</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('meraba', old('upaya_fisik'))) checked @endif id="upaya_fisik17" type="checkbox"
                  value='meraba'>
                <label class="custom-control-label" for="upaya_fisik17">- <strong>Meraba</strong> : Menyentuh dengan
                  jari atau telapak tangan untuk mengetahui sifat-sifat benda seperti suhu, bentuk</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('berbicara', old('upaya_fisik'))) checked @endif id="upaya_fisik18" type="checkbox"
                  value='berbicara'>
                <label class="custom-control-label" for="upaya_fisik18">- <strong>Berbicara</strong> : Menyatakan atau
                  bertukar pikiran secara lisan agar dapat dipahami</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('mendengar', old('upaya_fisik'))) checked @endif id="upaya_fisik19" type="checkbox"
                  value='mendengar'>
                <label class="custom-control-label" for="upaya_fisik19">- <strong>Mendengar</strong> : Menggunakan
                  telinga untuk mengetahui adanya suara</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('melihat', old('upaya_fisik'))) checked @endif id="upaya_fisik20" type="checkbox"
                  value='melihat'>
                <label class="custom-control-label" for="upaya_fisik20">- <strong>Melihat</strong> : Usaha mengetahui
                  dengan menggunakan mata</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('ketajaman jarak jauh', old('upaya_fisik'))) checked @endif id="upaya_fisik21"
                  type="checkbox" value='ketajaman jarak jauh'>
                <label class="custom-control-label" for="upaya_fisik21">- <strong>Ketajaman Jarak Jauh</strong> :
                  Kejelasan penglihatan dalam jarak lebih dari 5 meter</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('ketajaman jarak dekat', old('upaya_fisik'))) checked @endif id="upaya_fisik22"
                  type="checkbox" value='ketajaman jarak dekat'>
                <label class="custom-control-label" for="upaya_fisik22">- <strong>Ketajaman Jarak Dekat</strong>
                  :Kejelasan penglihatan dalam jarak kurang dari 5 meter</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('pengamatan secara mendalam', old('upaya_fisik'))) checked @endif id="upaya_fisik23"
                  type="checkbox" value='pengamatan secara mendalam'>
                <label class="custom-control-label" for="upaya_fisik23">- <strong>Pengamatan Secara Mendalam</strong> :
                  Penglihatan dalam 3 dimensi, untuk menetapkan hubungan antara jarak, ruang serta cara melihat benda
                  dimana benda tersebut berada dan sebagaimana adanya</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('penyesuaian lensa mata', old('upaya_fisik'))) checked @endif id="upaya_fisik24"
                  type="checkbox" value='penyesuaian lensa mata'>
                <label class="custom-control-label" for="upaya_fisik24">- <strong>Penyesuaian Lensa Mata</strong> :
                  Penyesuaian lensa mata untuk melihat suatu benda yang sangat penting bila melaksanakan pekerjaan yang
                  perlu dengan melihat benda-benda dalam jarak dan arah yang berbeda</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('melihat berbagai warna', old('upaya_fisik'))) checked @endif id="upaya_fisik25"
                  type="checkbox" value='melihat berbagai warna'>
                <label class="custom-control-label" for="upaya_fisik25">- <strong>Melihat Berbagai Warna</strong> :
                  Membedakan warna yang terdapat dalam pekerjaan</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="upaya_fisik[]" @if(is_array(old('upaya_fisik')) &&
                  in_array('luas', old('upaya_fisik'))) checked @endif id="upaya_fisik26" type="checkbox" value='luas'>
                <label class="custom-control-label" for="upaya_fisik26">- <strong>Luas</strong> : Melihat suatu daerah
                  pandang, ke atas dan ke bawah pandang atau ke kanan atau ke kiri sedang mata tetap berada di titik
                  tertentu</label>
              </div>
              @if ($errors->has('upaya_fisik'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('upaya_fisik') }}</strong>
              </span>
              @endif
            </div>
            <hr class="my-4" />
            <h4 class="heading-small text-muted mb-4">{{ __('Kondisi Fisik') }}</h4>
            <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
              <select
                class="form-select form-control- form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}"
                name="jenis_kelamin" id="jenis_kelamin" aria-label="Default select example" required>
                <option @if(old("jenis_kelamin")=='Tidak Dipersyaratkan' ) selected @endif value='Tidak Dipersyaratkan'>
                  Tidak Dipersyaratkan
                </option>
                <option @if(old("jenis_kelamin")=='Laki - Laki' ) selected @endif value='Laki - Laki'>Laki - Laki
                </option>
                <option @if(old("jenis_kelamin")=='Perempuan' ) selected @endif value='Perempuan'>Perempuan
                </option>
              </select>
              @if ($errors->has('jenis_kelamin'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('jenis_kelamin') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('umur') ? ' has-danger' : '' }}">

              <label class="form-control-label" for="umur">{{ __('Umur')}}</label>
              <div class="input-group mb-4">
                <input type="text" name="umur" id="umur"
                  class="form-control form-control-{{ $errors->has('umur') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Input Umur') }}" value="{{ old('umur','60 Tahun') }}" required>
              </div>
              @if ($errors->has('umur'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('umur') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('tinggi') ? ' has-danger' : '' }}">

              <label class="form-control-label" for="tinggi">{{ __('Tinggi Badan')}}</label>
              <div class="input-group mb-4">
                <input type="text" name="tinggi" id="tinggi"
                  class="form-control form-control-{{ $errors->has('tinggi') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Input Tinggi Badan') }}" value="{{ old('tinggi','Tidak Dipersyaratkan') }}"
                  required>
              </div>
              @if ($errors->has('tinggi'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tinggi') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('berat') ? ' has-danger' : '' }}">

              <label class="form-control-label" for="berat">{{ __('Berat Badan')}}</label>
              <div class="input-group mb-4">
                <input type="text" name="berat" id="berat"
                  class="form-control form-control-{{ $errors->has('berat') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Input Berat Badan') }}" value="{{ old('berat','Tidak Dipersyaratkan') }}"
                  required>
              </div>
              @if ($errors->has('berat'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('berat') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('postur') ? ' has-danger' : '' }}">

              <label class="form-control-label" for="postur">{{ __('Postur Badan')}}</label>
              <div class="input-group mb-4">
                <input type="text" name="postur" id="postur"
                  class="form-control form-control-{{ $errors->has('postur') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Input Postur Badan') }}" value="{{ old('postur','Tidak Dipersyaratkan') }}"
                  required>
              </div>
              @if ($errors->has('postur'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('postur') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('penampilan') ? ' has-danger' : '' }}">

              <label class="form-control-label" for="penampilan">{{ __('Penampilan')}}</label>
              <div class="input-group mb-4">
                <input type="text" name="penampilan" id="penampilan"
                  class="form-control form-control-{{ $errors->has('penampilan') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Input Tinggi') }}" value="{{ old('penampilan','Tidak Dipersyaratkan') }}"
                  required>
              </div>
              @if ($errors->has('penampilan'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('penampilan') }}</strong>
              </span>
              @endif
            </div>
            <hr class="my-4" />
            <h4 class="heading-small text-muted mb-4">{{ __('Fungsi Pekerjaan') }}</h4>
            <div class="form-group{{ $errors->has('hubungan_data') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="hubungan_data">{{ __('Hubungan Dengan Data') }}</label>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_data[]" @if(is_array(old('hubungan_data')) &&
                  in_array('D0', old('hubungan_data'))) checked @endif id="hubungan_data1" type="checkbox" value="D0">
                <label class="custom-control-label" for="hubungan_data1">- <strong>D0</strong> = Memadukan data</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_data[]" @if(is_array(old('hubungan_data')) &&
                  in_array('D1', old('hubungan_data'))) checked @endif id="hubungan_data2" type="checkbox" value="D1">
                <label class="custom-control-label" for="hubungan_data2">- <strong>D1</strong> = Mengkoordinasikan
                  data</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_data[]" @if(is_array(old('hubungan_data')) &&
                  in_array('D2', old('hubungan_data'))) checked @endif id="hubungan_data3" type="checkbox" value="D2">
                <label class="custom-control-label" for="hubungan_data3">- <strong>D2</strong> = Menganalisis
                  data</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_data[]" @if(is_array(old('hubungan_data')) &&
                  in_array('D3', old('hubungan_data'))) checked @endif id="hubungan_data4" type="checkbox" value="D3">
                <label class="custom-control-label" for="hubungan_data4">- <strong>D3</strong> = Menyusun data</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_data[]" @if(is_array(old('hubungan_data')) &&
                  in_array('D4', old('hubungan_data'))) checked @endif id="hubungan_data5" type="checkbox" value="D4">
                <label class="custom-control-label" for="hubungan_data5">- <strong>D4</strong> = Menghitung data</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_data[]" @if(is_array(old('hubungan_data')) &&
                  in_array('D5', old('hubungan_data'))) checked @endif id="hubungan_data6" type="checkbox" value="D5">
                <label class="custom-control-label" for="hubungan_data6">- <strong>D5</strong> = Membandingkan /
                  Mencocokkan data</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_data[]" @if(is_array(old('hubungan_data')) &&
                  in_array('D6', old('hubungan_data'))) checked @endif id="hubungan_data7" type="checkbox" value="D6">
                <label class="custom-control-label" for="hubungan_data7">- <strong>D6</strong> = Menyalin data</label>
              </div>

              @if ($errors->has('hubungan_data'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('hubungan_data') }}</strong>
              </span>
              @endif
            </div>
            <hr class="my-4" />
            <div class="form-group{{ $errors->has('hubungan_orang') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="hubungan_orang">{{ __('Hubungan Dengan Orang') }}</label>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O0', old('hubungan_orang'))) checked @endif id="hubungan_orang1" type="checkbox" value="O0">
                <label class="custom-control-label" for="hubungan_orang1">- <strong>O0</strong> = Menasehati</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O1', old('hubungan_orang'))) checked @endif id="hubungan_orang2" type="checkbox" value="O1">
                <label class="custom-control-label" for="hubungan_orang2">- <strong>O1</strong> = Berunding</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O2', old('hubungan_orang'))) checked @endif id="hubungan_orang3" type="checkbox" value="O2">
                <label class="custom-control-label" for="hubungan_orang3">- <strong>O2</strong> = Mengajar</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O3', old('hubungan_orang'))) checked @endif id="hubungan_orang4" type="checkbox" value="O3">
                <label class="custom-control-label" for="hubungan_orang4">- <strong>O3</strong> = Menyelia</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O4', old('hubungan_orang'))) checked @endif id="hubungan_orang5" type="checkbox" value="O4">
                <label class="custom-control-label" for="hubungan_orang5">- <strong>O4</strong> = Menghibur</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O5', old('hubungan_orang'))) checked @endif id="hubungan_orang6" type="checkbox" value="O5">
                <label class="custom-control-label" for="hubungan_orang6">- <strong>O5</strong> = Mempengaruhi</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O6', old('hubungan_orang'))) checked @endif id="hubungan_orang7" type="checkbox" value="O6">
                <label class="custom-control-label" for="hubungan_orang7">- <strong>O6</strong> = Berbicara - memberi
                  tanda</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O7', old('hubungan_orang'))) checked @endif id="hubungan_orang8" type="checkbox" value="O7">
                <label class="custom-control-label" for="hubungan_orang8">- <strong>O7</strong> = Melayani orang</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_orang[]" @if(is_array(old('hubungan_orang')) &&
                  in_array('O8', old('hubungan_orang'))) checked @endif id="hubungan_orang9" type="checkbox" value="O8">
                <label class="custom-control-label" for="hubungan_orang9">- <strong>O8</strong> = Menerima
                  instruksi</label>
              </div>
              @if ($errors->has('hubungan_orang'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('hubungan_orang') }}</strong>
              </span>
              @endif
            </div>
            <hr class="my-4" />
            <div class="form-group{{ $errors->has('hubungan_benda') ? ' has-danger' : '' }}">
              <label class="form-control-label" for="hubungan_benda">{{ __('Hubungan Dengan Benda') }}</label>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B0', old('hubungan_benda'))) checked @endif id="hubungan_benda1" type="checkbox" value="B0">
                <label class="custom-control-label" for="hubungan_benda1">- <strong>B0</strong> = Memasang mesin</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B1', old('hubungan_benda'))) checked @endif id="hubungan_benda2" type="checkbox" value="B1">
                <label class="custom-control-label" for="hubungan_benda2">- <strong>B1</strong> = Mengerjakan
                  persisi</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B2', old('hubungan_benda'))) checked @endif id="hubungan_benda3" type="checkbox" value="B2">
                <label class="custom-control-label" for="hubungan_benda3">- <strong>B2</strong> = Menjalankan -
                  mengontrol mesin</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B3', old('hubungan_benda'))) checked @endif id="hubungan_benda4" type="checkbox" value="B3">
                <label class="custom-control-label" for="hubungan_benda4">- <strong>B3</strong> = Mengemudikan /
                  menjalankan mesin</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B4', old('hubungan_benda'))) checked @endif id="hubungan_benda5" type="checkbox" value="B4">
                <label class="custom-control-label" for="hubungan_benda5">- <strong>B4</strong> = Mengerjakan benda
                  dengan tangan atau perkakas</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B5', old('hubungan_benda'))) checked @endif id="hubungan_benda6" type="checkbox" value="B5">
                <label class="custom-control-label" for="hubungan_benda6">- <strong>B5</strong> = Melayani mesin</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B6', old('hubungan_benda'))) checked @endif id="hubungan_benda7" type="checkbox" value="B6">
                <label class="custom-control-label" for="hubungan_benda7">- <strong>B6</strong> = Memasukkan,
                  mengeluarkan barang ke/dari mesin</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="hubungan_benda[]" @if(is_array(old('hubungan_benda')) &&
                  in_array('B7', old('hubungan_benda'))) checked @endif id="hubungan_benda8" type="checkbox" value="B7">
                <label class="custom-control-label" for="hubungan_benda8">- <strong>B7</strong> = Memegang</label>
              </div>

              @if ($errors->has('hubungan_benda'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('hubungan_benda') }}</strong>
              </span>
              @endif
              <hr class="my-4" />
              <div class="form-group{{ $errors->has('prestasi_harapan') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="prestasi_harapan">{{ __('Prestasi Kerja Yang Diharapkan')
                  }}</label>
                <textarea name="prestasi_harapan" id="prestasi_harapan" cols="30" rows="5"
                  class="form-control form-control-{{ $errors->has('prestasi_harapan') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Prestasi Kerja Yang Diharapkan') }}" value="{{ old('prestasi_harapan') }}"
                  required>{{ old('prestasi_harapan') }}</textarea>
                @if ($errors->has('prestasi_harapan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('prestasi_harapan') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-success mt-4">{{ __('Simpan') }}</button>
            </div>
          </div>
        </div>
      </div>
      </form>
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