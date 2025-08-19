@extends('layouts.app', ['title' => __('Kelola Faktor')])

@section('content')
@include('admin.header', ['halaman' => __('Kelola Faktor')])
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Daftar Faktor</h3>
            </div>
            <div class="col-4 text-right">
              <a href="\create-faktor" class=" btn btn-sm btn-primary p-2 btnTambah">Tambah Faktor</a>
            </div>

          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-6 text-center">
              @if (session()->has('success'))
              <div class=" my-2 alert text-center alert-info alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
              </div>
              @endif
              @if (session()->has('Errors'))
              <div class="my-2 alert text-center alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('Errors') }}</strong>
              </div>
              @endif
              {{-- @if ($errors->any())
              <div class="alert alert-danger my-2" role="alert">

                @foreach ($errors->all() as $error)

                <strong>{{ $error }}</strong><br>

                @endforeach

              </div>
              @endif --}}

              {{-- @error('id')
              <div class="alert alert-danger my-2" role="alert">
                <strong>{{ $message }}</strong>
              </div>
              @enderror --}}
            </div>
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table align-items-center table-flush" id="customerList" style="width: 100%">
              <thead class="thead-light">
                <tr>
                  {{-- <th scope="col">No</th> --}}
                  <th class="text-center">NO</th>
                  <th scope="col">Nama Faktor</th>
                  <th scope="col">Nilai</th>
                  <th scope="col">Tingkat</th>
                  <th scope="col">Jenis Faktor</th>
                  <th class="text-right pr-6">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $currentpage = request('page')?request('page'):1;
                $i = 1 + (10 * ( $currentpage- 1))
                @endphp
                @foreach ($faktor as $index)
                <tr>
                  <th class="text-center">
                    <?php echo $i++; ?>
                  </th>
                  {{-- <th class="text-center">
                    {{ $index->id }}
                  </th> --}}
                  <th>
                    {{ $index->nama_faktor }}
                  </th>
                  <th>
                    {{ $index->nilai }}
                  </th>
                  <th>
                    {{ $index->tingkat }}
                  </th>
                  <th>
                    @php
                    if ($index->jenis_jabatan == "6 Faktor"){
                    echo 'Jabatan Struktural';
                    }else {
                    echo 'Jabatan Fungsional & Pelaksana';
                    }
                    @endphp

                    {{-- {{ strtoupper($index->jenis_jabatan) }} --}}
                  </th>
                  <th>
                    <div class="text-right">
                      <a href="#" class="btn btn-info btn-sm btnEdit" data-id="{{ $index->id }}"
                        data-nama_faktor="{{ $index->nama_faktor }}" data-nilai="{{ $index->nilai }}"
                        data-indikator="{{ $index->indikator }}" data-bs-toggle="modal" data-bs-target="#editModal"><i
                          class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-id="{{ $index->id }}"
                        data-nama_faktor="{{ $index->nama_faktor }}" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>


                <?php endforeach; ?>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h3 class="modal-title">Hapus Faktor Jabatan?</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <form action="" name="deleteForm" id="deleteForm" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" id="id" class="deleteID">

                        <div class="modal-body">
                          <p>Yakin ingin menghapus <strong id="valuefaktor"></strong> ?<br>Semua data seperti
                            data jabatan, inputan dan semua yang berhubungan akan dihapus.</p>
                        </div>
                        <div class=" modal-footer justify-content-center">
                          <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-center">
            {{ $faktor->onEachSide(0)->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('admin.faktor.edit')
  {{-- @include('admin.opd.tambah') --}}

  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    $(document).ready(function(){
   
    $(document).on('click', '.btnDelete', function() {
            var id = $(this).data('id')
            var nama_faktor = $(this).data('nama_faktor')
            var APP_URL = {!! json_encode(url('/faktor-jabatan')) !!}
            document.getElementById("deleteForm").action = APP_URL+'/'+id;
            // document.getElementById("deleteForm").action = '/dinas/'+id;
            $('.deleteID').val(id);
            $('#valuefaktor').text(nama_faktor);
          })
    $(document).on('click', '.btnEdit', function() {
      var id = $(this).data('id')
      var nama_faktor = $(this).data('nama_faktor')
      var nilai = $(this).data('nilai')
      var indikator = $(this).data('indikator')
      // document.getElementById("editForm").action = '/dinas/'+id;
      var APP_URL = {!! json_encode(url('/faktor-jabatan')) !!}
      document.getElementById("editForm").action = APP_URL+'/'+id;
      $('.edit-id').val(id)
      $('.edit-name').val(nama_faktor);
      $('.edit-nilai').val(nilai);
      $('.edit-indikator').val(indikator);
      $('#indikator').text(indikator);
    })
  })
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush