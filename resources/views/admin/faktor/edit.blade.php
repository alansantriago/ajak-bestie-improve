<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent">
            <h3 class="card-heading text-center mt-2">Edit Faktor Jabatan</h3>
          </div>
          {{-- <script>
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
          } --}}
          {{-- 
          </script> --}}
          <div class="card-body px-lg-5 py-lg-5">
            <div id="isifaktor6" class="isifaktor6">
              @include('admin.faktor.faktor6')
            </div>
            {{-- <div id="isifaktor9" class="isifaktor9" hidden>
              @include('admin.faktor.faktor9')
            </div> --}}

          </div>
        </div>
      </div>
    </div>
  </div>
</div>