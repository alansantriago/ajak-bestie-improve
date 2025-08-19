<form role="form" action="" method="POST" id="editForm">
  @method('PUT')
  @csrf
  <input name="id" class="form-control edit-id" placeholder="Kode Organisasi Perangkat Daerah" type="number"
    maxlength="20" required hidden>
  <label class="col-form-label" for="nama_dinas">Nama Faktor Jabatan :</label>
  <div class="form-group mb-3">
    <div class="input-group input-group-merge input-group-alternative">
      <input name="nama_faktor" id='nama_faktor' class="form-control edit-name" placeholder="Nama Faktor Jabatan"
        type="text" maxlength="255" required readonly>
    </div>
    <div class="text-danger err name-error"></div>
  </div>
  <label class="col-form-label" for="nilai">Nilai Faktor Jabatan :</label>
  <div class="form-group mb-3">
    <div class="input-group input-group-merge input-group-alternative">
      <input name="nilai" id='nilai' class="form-control edit-nilai" placeholder="Nilai Faktor Jabatan" type="number"
        maxlength="8" required>
    </div>
    <div class="text-danger err name-error"></div>
  </div>
  <label class="col-form-label" for="indikator">Indikator Faktor Jabatan :</label>
  <div class="form-group mb-3">
    <div class="input-group input-group-merge input-group-alternative">

      <textarea name="indikator" id='indikator' class="form-control edit-indikator"
        placeholder="Indikator Faktor Jabatan" type="text" maxlength="" cols="50" rows="15" required></textarea>
    </div>
    <div class="text-danger err name-error"></div>
  </div>
  <div class="modal-footer justify-content-center">
    <button type="button" class="btn btn-danger btn-delete" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</form>