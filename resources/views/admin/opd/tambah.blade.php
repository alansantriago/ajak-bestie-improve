<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Tambah Organisasi Perangkat Daerah</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            <form role="form" action="" method="post" id="editCouponForm">
              @csrf
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                  </div>
                  <input name="nama_dinas" id='nama_dinas' class="form-control tambah-name"
                    placeholder="Nama Organisasi Perangkat Daerah" value="{{ old('nama_dinas') }}" type="text"
                    maxlength="255" required>
                </div>
                <div class="text-danger err name-error"></div>
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