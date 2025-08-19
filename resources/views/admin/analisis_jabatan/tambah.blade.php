<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Tambah Jabatan<br><strong id="valuedinastambah"></strong>
            </h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">

            <form role="form" action="" method="POST" id="tambahForm">
              @csrf
              @method('post')
              <input type="text" class="form-control-label dinas_id" value="{{ old('dinas_id') }}" name="dinas_id"
                id="dinas_id" hidden required>
              <input type="text" class="form-control-label tingkat" value="{{ old('tingkat') }}" name="tingkat"
                id="tingkat" hidden required>
              <div class="form-group{{ $errors->has('kode_jabatan') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="kode_jabatan">{{ __('Kode Jabatan') }}</label>
                <input type="text"
                  class="form-control kode_jabatan form-control-{{ $errors->has('kode_jabatan') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Kode Jabatan Otomatis') }}" value="{{ old('kode_jabatan') }}" required
                  readonly="true" name="kode_jabatan" id="kode_jabatan">
                @if ($errors->has('kode_jabatan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('kode_jabatan') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('jenis_jabatan') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="jenis_jabatan">{{ __('Jenis Jabatan') }}</label>
                <select
                  class="tambah-jenis_jabatan jenis_jabatan form-select selectpicker form-control form-control-{{ $errors->has('jenis_jabatan') ? ' is-invalid' : '' }}"
                  name="jenis_jabatan" id="jenis_jabatan" aria-label="Default select example" data-live-search="true"
                  required>
                  <option @if(old("jenis_jabatan")=='' ) selected @endif value='' disabled>Pilih Jenis Jabatan
                  </option>
                  <option id="struktural" hidden @if(old("jenis_jabatan")=='Struktural' ) selected @endif
                    value='Struktural'>Struktural
                  </option>
                  <option id="fungsional" hidden @if(old("jenis_jabatan")=='Fungsional' ) selected @endif
                    value='Fungsional'>Fungsional
                  </option>
                  <option id="pelaksana" hidden @if(old("jenis_jabatan")=='Pelaksana' ) selected @endif
                    value='Pelaksana'>Pelaksana
                  </option>
                </select>
                @if ($errors->has('nama_kompetensi'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('nama_kompetensi') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('jabatan') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="jabatan">{{ __('Jabatan') }}</label>
                <select
                  class="tambah-jabatan jabatan form-select selectpicker form-control form-control-{{ $errors->has('jabatan') ? ' is-invalid' : '' }}"
                  name="jabatan" id="jabatan" aria-label="Default select example" data-live-search="true" required>
                  <option selected value='' disabled>Pilih Jabatan
                  </option>


                </select>
                @if ($errors->has('jabatan'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('jabatan') }}</strong>
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