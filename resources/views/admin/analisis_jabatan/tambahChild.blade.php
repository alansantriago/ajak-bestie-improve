<div class="modal fade" id="tambahChildModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Tambah Jabatan<br><strong id="valuedinastambahchild"></strong>
            </h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">

            <form role="form" action="" method="POST" id="tambahFormchild">
              @csrf
              @method('post')
              <input type="text" class="form-control-label dinas_idchild" value="{{ old('dinas_idchild') }}"
                name="dinas_idchild" id="dinas_idchild" hidden required>
              <input type="text" class="form-control-label tingkatchild" value="{{ old('tingkatchild') }}"
                name="tingkatchild" id="tingkatchild" hidden required>
              <input type="text" class="form-control-label kode_jabatanparent" value="{{ old('kode_jabatanparent') }}"
                name="kode_jabatanparent" id="kode_jabatanparent" hidden required>
              <div class="form-group{{ $errors->has('kode_jabatanchild') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="kode_jabatanchild">{{ __('Kode Jabatan') }}</label>
                <input type="text" name="kode_jabatanchild" id="kode_jabatanchild"
                  class="form-control tambah-level form-control-{{ $errors->has('kode_jabatanchild') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Kode Jabatan Otomatis') }}" value="{{ old('kode_jabatanchild') }}" required
                  readonly="true">
                @if ($errors->has('kode_jabatanchild'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('kode_jabatanchild') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('jenis_jabatanchild') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="jenis_jabatanchild">{{ __('Jenis Jabatan') }}</label>
                <select
                  class="tambah-jenis_jabatanchild jenis_jabatanchild form-select selectpicker form-control form-control-{{ $errors->has('jenis_jabatanchild') ? ' is-invalid' : '' }}"
                  name="jenis_jabatanchild" id="jenis_jabatanchild" aria-label="Default select example"
                  data-live-search="true" required>
                  <option @if(old("jenis_jabatanchild")=='' ) selected @endif value='' disabled>Pilih Jenis Jabatan
                  </option>
                  <option id="strukturalchild" hidden @if(old("jenis_jabatanchild")=='Struktural' ) selected @endif
                    value='Struktural'>Struktural
                  </option>
                  <option id="fungsionalchild" hidden @if(old("jenis_jabatanchild")=='Fungsional' ) selected @endif
                    value='Fungsional'>Fungsional
                  </option>
                  <option id="pelaksanachild" hidden @if(old("jenis_jabatanchild")=='Pelaksana' ) selected @endif
                    value='Pelaksana'>Pelaksana
                  </option>
                </select>
                @if ($errors->has('jenis_jabatanchild'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('jenis_jabatanchild') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('jabatanchild') ? ' has-danger' : '' }}">

                <label class="form-control-label" for="jabatanchild">{{ __('Jabatan') }}</label>
                <select
                  class="tambah-jabatanchild jabatanchild form-select selectpicker form-control form-control-{{ $errors->has('jabatanchild') ? ' is-invalid' : '' }}"
                  name="jabatanchild" id="jabatanchild" aria-label="Default select example" data-live-search="true"
                  required>
                  <option selected value='' disabled>Pilih Jabatan
                  </option>


                </select>
                @if ($errors->has('jabatanchild'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('jabatanchild') }}</strong>
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