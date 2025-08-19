<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Edit Organisasi Perangkat Daerah</h3>
          </div>
          <div class="card-body px-lg-5 py-lg-5">

            <div class="form-group mb-3">
              <script>
                window.onload = function() {
                    btn6faktor();
                   };
                function btn6faktor(){
                
                let faktor6 = document.getElementById("isifaktor6");
                faktor6.removeAttribute("hidden");
                let faktor9 = document.getElementById("isifaktor9");
                faktor9.setAttribute("hidden", "hidden");
                // faktor9.style.display === "none";
              }
              function btn9faktor(){
                
                let faktor6 = document.getElementById("isifaktor6");
                faktor6.setAttribute("hidden", "hidden");
                let faktor9 = document.getElementById("isifaktor9");
                faktor9.removeAttribute("hidden");
                // faktor9.style.display === "none";
              }
              </script>
              <button type="button" id="btn6faktor" class="btn btn-info btn6faktor" onclick="btn6faktor()">6
                Faktor</button>
              <button type="button" id="btn9faktor" class="btn btn-info btn9faktor" onclick="btn9faktor()">9
                Faktor</button>
            </div>

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
            <div id="isifaktor6" class="isifaktor6 " hidden>
              @include('admin.informasi_faktor.faktor6')
            </div>
            <div id="isifaktor9" class="isifaktor9" hidden>
              @include('admin.informasi_faktor.faktor9')
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- @push('js')
<script>
  function btn6faktor(){
    
        document.getElementById("isifaktor6")style.display === "none";
        document.getElementById("isifaktor9")style.display === "block";
      }
</script>
@endpush --}}