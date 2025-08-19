<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Edit Standar Kompetensi Jabatan</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            <label class="form-control-label" for="nama_jabatan">Nama Jabatan :</label>
            <div class="form-group mb-3">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                </div>
                <input name="nama_jabatan" id='nama_jabatan' class="form-control edit-name" placeholder="Nama Jabatan"
                  type="text" maxlength="255" required>
              </div>
              <div class="text-danger err name-error"></div>
            </div>
            <form role="form" action="" method="POST" id="editForm">
              @csrf
              @method('PUT')
              <input name="id" class="form-control" placeholder="Kode Organisasi Perangkat Daerah" type="number"
                maxlength="20" required hidden>
              <div class="form-group kelompok_jabatan{{ $errors->has('kelompok_jabatan') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="kelompok_jabatan">{{ __('Kelompok Jabatan') }}</label>
                <select data-live-search="true"
                  class="form-select selectpicker form-control- form-control{{ $errors->has('kelompok_jabatan') ? ' is-invalid' : '' }}"
                  name="kelompok_jabatan" id="kelompok_jabatan" aria-label="Default select example" required>
                  <option @if(old("kelompok_jabatan")=='' ) selected @endif value='' disabled>Pilih Kelompok Jabatan
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Administrator' ) selected @endif
                    value='Jabatan Administrator'>Jabatan Administrator
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Pengawas' ) selected @endif value='Jabatan Pengawas'>
                    Jabatan Pengawas
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Pelaksana' ) selected @endif value='Jabatan Pelaksana'>
                    Jabatan Pelaksana
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Ahli Pertama' ) selected @endif
                    value='Jabatan Fungsional Ahli Pertama'>Jabatan Fungsional Ahli Pertama
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Ahli Muda' ) selected @endif
                    value='Jabatan Fungsional Ahli Muda'>Jabatan Fungsional Ahli Muda
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Ahli Madya' ) selected @endif
                    value='Jabatan Fungsional Ahli Madya'>Jabatan Fungsional Ahli Madya
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Ahli Utama' ) selected @endif
                    value='Jabatan Fungsional Ahli Utama'>Jabatan Fungsional Ahli Utama
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Pemula' ) selected @endif
                    value='Jabatan Fungsional Pemula'>Jabatan Fungsional Pemula
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Terampil' ) selected @endif
                    value='Jabatan Fungsional Terampil'>Jabatan Fungsional Terampil
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Mahir' ) selected @endif
                    value='Jabatan Fungsional Mahir'>Jabatan Fungsional Mahir
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Fungsional Penyelia' ) selected @endif
                    value='Jabatan Fungsional Penyelia'>Jabatan Fungsional Penyelia
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Pimpinan Tinggi Pratama' ) selected @endif
                    value='Jabatan Pimpinan Tinggi Pratama '>Jabatan Pimpinan Tinggi Pratama
                  </option>
                  <option @if(old("kelompok_jabatan")=='Jabatan Pimpinan Tinggi Madya' ) selected @endif
                    value='Jabatan Pimpinan Tinggi Madya '>Jabatan Pimpinan Tinggi Madya
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
                  placeholder="{{ __('Urusan Pemerintahan') }}" value="{{ old('urusan_pemerintahan') }}" required
                  autofocus>

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
                  name="integritas" id="integritas" aria-label="Default select example" data-live-search="true"
                  required>
                  <option @if(old("integritas")=='' ) selected @endif value='' disabled>Pilih Integritas</option>
                  @php
                  $integritas = standarkompetensi('Integritas');
                  @endphp
                  @foreach ($integritas as $index)
                  <option @if(old("integritas")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
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
                  name="kerjasama" id="kerjasama" aria-label="Default select example" required>
                  <option @if(old("kerjasama")=='' ) selected @endif value='' disabled>Pilih Kerjasama</option>
                  @php
                  $kerjasama = standarkompetensi('Kerjasama');
                  @endphp
                  @foreach ($kerjasama as $index)
                  <option @if(old("kerjasama")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>Kerjasama
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
                  name="komunikasi" id="komunikasi" aria-label="Default select example" required>
                  <option @if(old("komunikasi")=='' ) selected @endif value='' disabled>Pilih Komunikasi</option>
                  @php
                  $komunikasi = standarkompetensi('Komunikasi');
                  @endphp
                  @foreach ($komunikasi as $index)
                  <option @if(old("komunikasi")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
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
                  name="orientasi" id="orientasi" aria-label="Default select example" required>
                  <option @if(old("orientasi")=='' ) selected @endif value='' disabled>Pilih Orientasi</option>
                  @php
                  $orientasi = standarkompetensi('Orientasi Pada Hasil');
                  @endphp
                  @foreach ($orientasi as $index)
                  <option @if(old("orientasi")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>Orientasi
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
                  name="pelayanan_publik" id="pelayanan_publik" aria-label="Default select example" required>
                  <option @if(old("pelayanan_publik")=='' ) selected @endif value='' disabled>Pilih Pelayanan Publik
                  </option>
                  @php
                  $pelayanan_publik = standarkompetensi('Pelayanan Publik');
                  @endphp
                  @foreach ($pelayanan_publik as $index)
                  <option @if(old("pelayanan_publik")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
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
                  name="pengembangan_diri" id="pengembangan_diri" aria-label="Default select example" required>
                  <option @if(old("pengembangan_diri")=='' ) selected @endif value='' disabled>Pilih Pengembangan Diri
                    dan orang lain
                  </option>
                  @php
                  $pengembangan_diri = standarkompetensi('Pengembangan diri dan Orang Lain');
                  @endphp
                  @foreach ($pengembangan_diri as $index)
                  <option @if(old("pengembangan_diri")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
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
                  name="mengelola_perubahan" id="mengelola_perubahan" aria-label="Default select example" required>
                  <option @if(old("mengelola_perubahan")=='' ) selected @endif value='' disabled>Pilih Mengelola
                    Perubahan
                  </option>
                  @php
                  $mengelola_perubahan = standarkompetensi('Mengelola Perubahan');
                  @endphp
                  @foreach ($mengelola_perubahan as $index)
                  <option @if(old("mengelola_perubahan")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
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
                  name="pengambilan_keputusan" id="pengambilan_keputusan" aria-label="Default select example" required>
                  <option @if(old("pengambilan_keputusan")=='' ) selected @endif value='' disabled>Pilih Pengambilan
                    Keputusan
                  </option>
                  @php
                  $pengambilan_keputusan = standarkompetensi('Pengambilan Keputusan');
                  @endphp
                  @foreach ($pengambilan_keputusan as $index)
                  <option @if(old("pengambilan_keputusan")=='{{ $index->id }}' ) selected @endif
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
                  name="perekat_bangsa" id="perekat_bangsa" aria-label="Default select example" required>
                  <option @if(old("perekat_bangsa")=='' ) selected @endif value='' disabled>Pilih Perekat Bangsa
                  </option>
                  @php
                  $perekat_bangsa = standarkompetensi('Perekat Bangsa');
                  @endphp
                  @foreach ($perekat_bangsa as $index)
                  <option @if(old("perekat_bangsa")=='{{ $index->id }}' ) selected @endif value='{{ $index->id }}'>
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
                  <option @if(old("pangkat")=='' ) selected @endif value='' disabled>Pilih Pangkat
                  </option>
                  <option @if(old("pangkat")=='Juru / (I.c)' ) selected @endif value='Juru / (I.c)'>Juru /
                    <Strong>(I.c)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Juru Muda Tk. I (I.b)' ) selected @endif value='Juru Muda Tk. I (I.b)'>
                    Juru
                    Muda Tk. I / <Strong>(I.b)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Juru Muda / (I.a)' ) selected @endif value='Juru Muda / (I.a)'>Juru Muda
                    /
                    <Strong>(I.a)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Pengatur / (II.c)' ) selected @endif value='Pengatur / (II.c)'>Pengatur /
                    <Strong>(II.c)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Pengatur Muda Tk I (II.b)' ) selected @endif
                    value='Pengatur Muda Tk I (II.b)'>Pengatur Muda Tk I / <Strong>(II.b)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Pengatur Muda / (II.a)' ) selected @endif value='Pengatur Muda / (II.a)'>
                    Pengatur Muda / <Strong>(II.a)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Penata Tk. I / (III.d)' ) selected @endif
                    value='Penata Tk. I / (III.d) '>
                    Penata Tk. I / <Strong>(III.d)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Penata / (III.c)' ) selected @endif value='Penata / (III.c)'>Penata /
                    <Strong>(III.c)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Penata Muda Tk. I / (III.b)' ) selected @endif
                    value='Penata Muda Tk. I / (III.b)'>Penata Muda Tk. I / <Strong>(III.b)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Penata Muda / (III.a)' ) selected @endif value='Penata Muda / (III.a)'>
                    Penata Muda / <Strong>(III.a)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Pembina Utama Muda / (IV.d)' ) selected @endif
                    value='Pembina Utama Muda / (IV.d)'>Pembina Utama Muda / <Strong>(IV.d)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Pembina Utama Muda / (IV.c)' ) selected @endif
                    value='Pembina Utama Muda / (IV.c)'>Pembina Utama Muda / <Strong>(IV.c)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Pembina Tk. I / (IV.b)' ) selected @endif value='Pembina Tk. I / (IV.b)'>
                    Pembina Tk. I / <Strong>(IV.b)</Strong>
                  </option>
                  <option @if(old("pangkat")=='Pembina / (IV.a)' ) selected @endif value='Pembina / (IV.a)'>Pembina /
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
                  value="{{ old('indikator_kinerja') }}">{{ old('indikator_kinerja') }}</textarea>
                @if ($errors->has('indikator_kinerja'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('indikator_kinerja') }}</strong>
                </span>
                @endif
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>