<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Edit Informasi Faktor Jabatan</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">

            <label class="col-form-label" for="nama_jabatan">Nama Jabatan :</label>
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
            <div id="isifaktor9" class="isifaktor9">
              @include('admin.informasi_faktor.faktor9')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>