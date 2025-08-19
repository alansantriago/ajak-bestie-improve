<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Tambah Kompetensi Manajerial</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">

            <form role="form" action="" method="POST" id="tambahForm">
              @csrf
              @method('post')

              <div class="form-group {{ $errors->has('nama_kompetensi') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="nama_kompetensi">{{ __('Nama Kompetensi') }}</label>
                <select
                  class="tambah-nama form-select selectpicker form-control form-control-{{ $errors->has('nama_kompetensi') ? ' is-invalid' : '' }}"
                  name="nama_kompetensi" id="nama_kompetensi" aria-label="Default select example"
                  data-live-search="true" required>
                  <option @if(old("nama_kompetensi")=='' ) selected @endif value='' disabled>Pilih Nama Kompetensi
                  </option>
                  <option @if(old("nama_kompetensi")=='Integritas' ) selected @endif value='Integritas'>Integritas
                  </option>
                  <option @if(old("nama_kompetensi")=='Kerjasama' ) selected @endif value='Kerjasama'>Kerjasama</option>
                  <option @if(old("nama_kompetensi")=='Komunikasi' ) selected @endif value='Komunikasi'>Komunikasi
                  </option>
                  <option @if(old("nama_kompetensi")=='Orientasi Pada Hasil' ) selected @endif
                    value='Orientasi Pada Hasil'>Orientasi Pada Hasil</option>
                  <option @if(old("nama_kompetensi")=='Pelayanan Publik' ) selected @endif value='Pelayanan Publik'>
                    Pelayanan Publik</option>
                  <option @if(old("nama_kompetensi")=='Pengembangan diri dan Orang Lain' ) selected @endif
                    value='Pengembangan diri dan Orang Lain'>Pengembangan diri dan Orang Lain
                  </option>
                  <option @if(old("nama_kompetensi")=='Mengelola Perubahan' ) selected @endif
                    value='Mengelola Perubahan'>Mengelola Perubahan
                  </option>
                  <option @if(old("nama_kompetensi")=='Pengambilan Keputusan' ) selected @endif
                    value='Pengambilan Keputusan'>Pengambilan Keputusan
                  </option>
                  <option @if(old("nama_kompetensi")=='Perekat Bangsa' ) selected @endif value='Perekat Bangsa'>Perekat
                    Bangsa
                  </option>
                </select>
                @if ($errors->has('nama_kompetensi'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nama_kompetensi') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="level">{{ __('Level Kompetensi') }}</label>
                <input type="number" name="level" id="level"
                  class="form-control tambah-level form-control-{{ $errors->has('level') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Level Kompetensi') }}" value="{{ old('level') }}" required min="1" max="20">
                @if ($errors->has('level'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('level') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('deskripsi') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="deskripsi">{{ __('Deskripsi Kompetensi') }}</label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                  class="form-control tambah-deskripsi form-control-{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Deskripsi Kompetensi') }}" value="{{ old('deskripsi') }}"
                  required>{{ old('deskripsi') }}</textarea>
                @if ($errors->has('deskripsi'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('deskripsi') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('indikator') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="indikator">{{ __('Indikator Kompetensi') }}</label>
                <textarea name="indikator" id="indikator" cols="30" rows="10"
                  class="form-control tambah-indikator form-control-{{ $errors->has('indikator') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Masukkan Indikator Kompetensi') }}" value="{{ old('indikator') }}"
                  required>{{ old('indikator') }}</textarea>
                @if ($errors->has('indikator'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('indikator') }}</strong>
                </span>
                @endif
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-simpan btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>