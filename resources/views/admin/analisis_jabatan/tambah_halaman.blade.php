@extends('layouts.app', ['title' => __('Edit Kompetensi Jabatan '.request('jabatan'))])

@section('content')
@include('admin.header', ['halaman' => __('Edit Kompetensi Jabatan '.request('jabatan'))])
<div class="container-fluid mt--7">
  <div class="row justify-content-center">
    <div class="col-xl-6 order-xl-1 mb-3">
      {{-- Informasi Jabatan --}}
      <div class="card bg-secondary shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="col-xl-12 order-xl-1 mb-3">
            <h3 class="text-center mt-3">{{ __('Jabatan ').request('jabatan') }}</h3>
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

            <form role="form" action="/standar-kompetensi/{{$jabatan->id}}" method="POST" id="editForm">
              @csrf
              @method('PUT')
              <input name="id" class="form-control" placeholder="Kode Organisasi Perangkat Daerah" type="number"
                maxlength="20" value="{{$jabatan->id}}" required hidden>
              <div class="form-group kelompok_jabatan{{ $errors->has('kelompok_jabatan') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="kelompok_jabatan">{{ __('Kelompok Jabatan') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('kelompok_jabatan') ? ' is-invalid' : '' }}"
                  name="kelompok_jabatan" id="kelompok_jabatan" aria-label="Default select example" required>
                  <option @if(old("kelompok_jabatan",($standar_kompetensi !=NULL) ? $standar_kompetensi->
                    kelompok_jabatan : '')=='' ) selected @endif
                    value='' disabled>Pilih Kelompok Jabatan
                  </option>
                  <option @if(old("kelompok_jabatan",($standar_kompetensi !=NULL) ? $standar_kompetensi->
                    kelompok_jabatan : '')=='Jabatan Administrator' )
                    selected @endif
                    value='Jabatan Administrator'>Jabatan Administrator
                  </option>
                  <option @if(old("kelompok_jabatan",($standar_kompetensi !=NULL) ? $standar_kompetensi->
                    kelompok_jabatan : '')=='Jabatan Pengawas' )
                    selected @endif value='Jabatan Pengawas'>
                    Jabatan Pengawas
                  </option>
                  <option @if(old("kelompok_jabatan",($standar_kompetensi !=NULL) ? $standar_kompetensi->
                    kelompok_jabatan : '')=='Jabatan Pelaksana' )
                    selected @endif value='Jabatan Pelaksana'>
                    Jabatan Pelaksana
                  </option>
                  
                </select>
                @if ($errors->has('kelompok_jabatan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('kelompok_jabatan') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('urusan_pemerintahan') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="urusan_pemerintahan">{{ __('Urusan Pemerintahan') }}</label>
                <input type="text" name="urusan_pemerintahan" id="urusan_pemerintahan"
                  class="form-control form-control-{{ $errors->has('urusan_pemerintahan') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Urusan Pemerintahan') }}"
                  value="{{ old('urusan_pemerintahan',($standar_kompetensi != NULL) ? $standar_kompetensi->urusan_pemerintahan : '') }}"
                  required autofocus>

                @if ($errors->has('urusan_pemerintahan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('urusan_pemerintahan') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('integritas') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="integritas">{{ __('Integritas') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- selectpicker form-control{{ $errors->has('integritas') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="integritas" aria-label="Default select example" data-live-search="true"
                  required>
                  <option selected value='' disabled>Pilih Integritas</option>
                  @php
                  $integritas = standarkompetensi('Integritas');
                  @endphp
                  @foreach ($integritas as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>
                    Integritas
                    - Level {{ $index->level }}
                  </option>
                  @endforeach

                </select>
                @if ($errors->has('integritas'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('integritas') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('kerjasama') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="kerjasama">{{ __('Kerjasama') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('kerjasama') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="kerjasama" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Kerjasama</option>
                  @php
                  $kerjasama = standarkompetensi('Kerjasama');
                  @endphp
                  @foreach ($kerjasama as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>Kerjasama
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('kerjasama'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('kerjasama') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('komunikasi') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="komunikasi">{{ __('Komunikasi') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('komunikasi') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="komunikasi" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Komunikasi</option>
                  @php
                  $komunikasi = standarkompetensi('Komunikasi');
                  @endphp
                  @foreach ($komunikasi as $index)
                  <option @if(is_array(old('komunikasi', $kompetensi)) && in_array($index->id,
                    old('komunikasi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>
                    Komunikasi
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('komunikasi'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('komunikasi') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('orientasi') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="orientasi">{{ __('Orientasi') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('orientasi') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="orientasi" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Orientasi</option>
                  @php
                  $orientasi = standarkompetensi('Orientasi Pada Hasil');
                  @endphp
                  @foreach ($orientasi as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>Orientasi
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('orientasi'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('orientasi') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('pelayanan_publik') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="pelayanan_publik">{{ __('Pelayanan Publik') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('pelayanan_publik') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="pelayanan_publik" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Pelayanan Publik
                  </option>
                  @php
                  $pelayanan_publik = standarkompetensi('Pelayanan Publik');
                  @endphp
                  @foreach ($pelayanan_publik as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>
                    Pelayanan Publik
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('pelayanan_publik'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('pelayanan_publik') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('pengembangan_diri') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="pengembangan_diri">{{ __('Pengembangan Diri dan orang lain')
                  }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('pengembangan_diri') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="pengembangan_diri" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Pengembangan Diri
                    dan orang lain
                  </option>
                  @php
                  $pengembangan_diri = standarkompetensi('Pengembangan diri dan Orang Lain');
                  @endphp
                  @foreach ($pengembangan_diri as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>
                    Pengembangan Diri dan orang lain
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('pengembangan_diri'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('pengembangan_diri') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('mengelola_perubahan') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="mengelola_perubahan">{{ __('Mengelola Perubahan') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('mengelola_perubahan') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="mengelola_perubahan" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Mengelola
                    Perubahan
                  </option>
                  @php
                  $mengelola_perubahan = standarkompetensi('Mengelola Perubahan');
                  @endphp
                  @foreach ($mengelola_perubahan as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>
                    Mengelola Perubahan
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('mengelola_perubahan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('mengelola_perubahan') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('pengambilan_keputusan') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="pengambilan_keputusan">{{ __('Pengambilan Keputusan') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('pengambilan_keputusan') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="pengambilan_keputusan" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Pengambilan
                    Keputusan
                  </option>
                  @php
                  $pengambilan_keputusan = standarkompetensi('Pengambilan Keputusan');
                  @endphp
                  @foreach ($pengambilan_keputusan as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif
                    value='{{ $index->id }}'>
                    Pengambilan Keputusan
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('pengambilan_keputusan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('pengambilan_keputusan') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('perekat_bangsa') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="perekat_bangsa">{{ __('Perekat Bangsa') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('perekat_bangsa') ? ' is-invalid' : '' }}"
                  name="kompetensi[]" id="perekat_bangsa" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih Perekat Bangsa
                  </option>
                  @php
                  $perekat_bangsa = standarkompetensi('Perekat Bangsa');
                  @endphp
                  @foreach ($perekat_bangsa as $index)
                  <option @if(is_array(old('kompetensi', $kompetensi)) && in_array($index->id,
                    old('kompetensi',$kompetensi)))
                    selected @endif value='{{ $index->id }}'>
                    Perekat Bangsa
                    - Level {{ $index->level }}
                  </option>
                  @endforeach
                </select>
                @if ($errors->has('perekat_bangsa'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('perekat_bangsa') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('pangkat') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="pangkat">{{ __('Pangkat') }}</label>
                <select
                  class="form-select selectpicker form-control- form-control{{ $errors->has('pangkat') ? ' is-invalid' : '' }}"
                  name="pangkat" id="pangkat" aria-label="Default select example" required>
                  <option selected value='' disabled>Pilih
                    Pangkat
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Juru /
                    (I.c)' ) selected @endif value='Juru / (I.c)'>Juru / <Strong>(I.c)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Juru
                    Muda Tk. I (I.b)' ) selected @endif
                    value='Juru Muda Tk. I (I.b)'>
                    Juru
                    Muda Tk. I / <Strong>(I.b)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Juru
                    Muda / (I.a)' ) selected @endif
                    value='Juru Muda / (I.a)'>Juru Muda

                    <Strong>(I.a)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Pengatur
                    / (II.c)' ) selected @endif
                    value='Pengatur / (II.c)'>Pengatur /
                    <Strong>(II.c)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Pengatur
                    Muda Tk I (II.b)' ) selected @endif
                    value='Pengatur Muda Tk I (II.b)'>Pengatur Muda Tk I / <Strong>(II.b)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Pengatur
                    Muda / (II.a)' ) selected @endif
                    value='Pengatur Muda / (II.a)'>
                    Pengatur Muda / <Strong>(II.a)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Penata
                    Tk. I / (III.d)' ) selected @endif
                    value='Penata Tk. I / (III.d) '>
                    Penata Tk. I / <Strong>(III.d)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Penata /
                    (III.c)' ) selected @endif
                    value='Penata / (III.c)'>Penata /
                    <Strong>(III.c)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Penata
                    Muda Tk. I / (III.b)' ) selected
                    @endif
                    value='Penata Muda Tk. I / (III.b)'>Penata Muda Tk. I / <Strong>(III.b)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Penata
                    Muda / (III.a)' ) selected @endif
                    value='Penata Muda / (III.a)'>
                    Penata Muda / <Strong>(III.a)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Pembina
                    Utama Muda / (IV.d)' ) selected
                    @endif
                    value='Pembina Utama Muda / (IV.d)'>Pembina Utama Muda / <Strong>(IV.d)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Pembina
                    Utama Muda / (IV.c)' ) selected
                    @endif
                    value='Pembina Utama Muda / (IV.c)'>Pembina Utama Muda / <Strong>(IV.c)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Pembina
                    Tk. I / (IV.b)' ) selected @endif
                    value='Pembina Tk. I / (IV.b)'>
                    Pembina Tk. I / <Strong>(IV.b)</Strong>
                  </option>
                  <option @if(old("pangkat",($standar_kompetensi !=NULL) ? $standar_kompetensi->pangkat : '')=='Pembina
                    / (IV.a)' ) selected @endif
                    value='Pembina / (IV.a)'>Pembina /
                    <Strong>(IV.a)</Strong>
                  </option>
                </select>
                @if ($errors->has('pangkat'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('pangkat') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('indikator_kinerja') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="indikator_kinerja">{{ __('Indikator Kinerja') }}</label>
                <textarea name="indikator_kinerja" id="indikator_kinerja" cols="30" rows="10"
                  class="form-control form-control-{{ $errors->has('indikator_kinerja') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Indikator Kinerja') }}"
                  value="{{ old('indikator_kinerja',($standar_kompetensi != NULL) ? $standar_kompetensi->indikator_kinerja : '') }}">{{ old('indikator_kinerja',($standar_kompetensi != NULL) ? $standar_kompetensi->indikator_kinerja : '') }}</textarea>
                @if ($errors->has('indikator_kinerja'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('indikator_kinerja') }}</strong>
                </span>
                @endif
              </div>
              <div class="modal-footer justify-content-center">
                {{-- <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal">Batal</button> --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
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