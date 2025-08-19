<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Edit Organisasi Perangkat Daerah</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">
            <form role="form" action="" method="POST" id="editForm">
              @method('PUT')
              @csrf

              <label class="col-form-label" for="id">Kode OPD :</label>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend ">
                    <span class="input-group-text "><i class="ni ni-key-25"></i></span>
                  </div>
                  <input name="id" class="form-control edit-id" placeholder="Kode Organisasi Perangkat Daerah"
                    type="number" maxlength="20" required>
                </div>
                <div class="text-danger err name-error"></div>
              </div>
              <label class="col-form-label" for="nama_dinas">Nama OPD :</label>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                  </div>
                  <input name="nama_dinas" id='nama_dinas' class="form-control edit-name"
                    placeholder="Nama Organisasi Perangkat Daerah" type="text" maxlength="255" required>
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