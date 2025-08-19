<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Edit Account</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            <form role="form" action="" method="POST" id="editForm">
              @method('PUT')
              @csrf

              {{-- <label class="col-form-label" for="id">Kode OPD :</label> --}}
              {{-- <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend ">
                    <span class="input-group-text "><i class="ni ni-key-25"></i></span>
                  </div> --}}
                  <input name="id" class="form-control edit-id" placeholder="" type="number" maxlength="20" required
                    hidden>
                  {{--
                </div>
                <div class="text-danger err name-error"></div>
              </div> --}}
              <label class="form-control-label" for="nama_dinas">Nama :</label>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <input name="name" id='name' class="form-control edit-name" placeholder="Masukkan Nama Account"
                    type="text" maxlength="255" required>
                </div>
                <div class="text-danger err name-error"></div>
              </div>
              <label class="form-control-label" for="email">Email :</label>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <input name="email" id='email' class="form-control edit-email" placeholder="Masukkan Email Account"
                    type="email" required>
                </div>
                <div class="text-danger err name-error"></div>
              </div>
              <label class="form-control-label" for="password">Password :</label>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <input name="password" id='password' class="form-control edit-password"
                    placeholder="Kosongkan jika tidak ingin ganti password" type="password" maxlength="255">

                </div>
                <div class="text-danger err name-error"></div>
              </div>
              <label class="form-control-label" for="password">Role :</label>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <select
                    class="edit-role form-select form-control form-control-alternative{{ $errors->has('role') ? ' is-invalid' : '' }}"
                    name="role" id="role" aria-label="Default select example" required onchange="hakakses()">
                    <option @if(old("role")=='' ) selected @endif value='' disabled>Pilih Tingkat Faktor</option>
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
                </div>
                <div class="text-danger err name-error"></div>
              </div>
              <div id="divakses" class="form-group{{ $errors->has('hak_akses') ? ' has-danger' : '' }}">
                <label class="form-control-label" for="hak_akses">{{ __('Hak Akses Akun :') }}</label>
                <select
                  class="edit-hak_akses form-select form-control form-control-alternative{{ $errors->has('hak_akses') ? ' is-invalid' : '' }}"
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
