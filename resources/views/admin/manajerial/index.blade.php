@extends('layouts.app', ['title' => __('Kelola Standar Kompetensi Manajerial')])

@section('content')
@include('admin.header', ['halaman' => __('Kelola Standar Kompetensi Manajerial')])
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Daftar Standar Kompetensi Manajerial</h3>
            </div>
            <div class="col-4 text-right">
              <a href="#" class="btn btn-sm btn-primary p-2 btnTambah" data-bs-toggle="modal"
                data-bs-target="#tambahModal">Tambah</a>
            </div>

          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-6 text-center">
              @if (session()->has('success'))
              <div class="alert alert-info my-2" role="alert">
                <strong>{{ session('success') }}</strong>
              </div>
              @endif
              @if (session()->has('failed'))
              <div class="alert alert-danger my-2" role="alert">
                <strong>{{ session('failed') }}</strong>
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger my-2" role="alert">

                @foreach ($errors->all() as $error)

                <strong>{{ $error }}</strong><br>

                @endforeach

              </div>
              @endif
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
                  <th scope="col">Nama Manajerial</th>
                  <th scope="col">Level</th>
                  <th scope="col">Deskripsi</th>
                  <th class="text-right pr-6">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $currentpage = request('page')?request('page'):1;
                $i = 1 + (10 * ( $currentpage- 1))
                @endphp
                @foreach ($manajerial as $index)
                <tr>
                  <th scope="col">
                    <?php echo $i++; ?>
                  </th>
                  {{-- <th class="text-center">
                    {{ $index->id }}
                  </th> --}}
                  <th>
                    {{ $index->nama_kompetensi}}
                  </th>
                  <th>
                    Level ke-{{ $index->level }}
                  </th>
                  <th>{{ substr($index->deskripsi, 0, 100) }}</th>
                  <th>
                    <div class="text-right">
                      <a href="#" class="btn btn-info btn-sm btnEdit" data-indikator="{{ $index->indikator }}"
                        data-deskripsi="{{ $index->deskripsi }}" data-level="{{ $index->level }}"
                        data-id="{{ $index->id }}" data-nama_kompetensi="{{ $index->nama_kompetensi }}"
                        data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i> Edit</a>

                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-id="{{ $index->id }}"
                        data-nama_dinas="{{ $index->nama_kompetensi}} Level ke-{{ $index->level }}"
                        data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>


                <?php endforeach; ?>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h3 class="modal-title">Hapus Kompetensi Manajerial?</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <form action="" name="deleteForm" id="deleteForm" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" id="id" class="deleteID">

                        <div class="modal-body">
                          <p>Yakin ingin menghapus <strong id="valuedinas"></strong> ?<br>Data yang dihapus tidak dapat
                            dikembalikan!</p>
                        </div>
                        <div class="modal-footer justify-content-center">
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
            {{ $manajerial->onEachSide(0)->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('admin.manajerial.edit')
  @include('admin.manajerial.tambah')

  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    $(document).ready(function(){
      $('.edit-nama').selectpicker();
      $('.tambah-nama').selectpicker();
    $(document).on('click', '.btnDelete', function() {
            var id = $(this).data('id')
            var nama_dinas = $(this).data('nama_dinas')
            var APP_URL = {!! json_encode(url('/manajerial')) !!}
            document.getElementById("deleteForm").action = APP_URL+'/'+id;
            // document.getElementById("deleteForm").action = '/dinas/'+id;
            $('.deleteID').val(id);
            $('#valuedinas').text(nama_dinas);
          })
    $(document).on('click', '.btnEdit', function() {
      var id = $(this).data('id')
      var level = $(this).data('level')
      var indikator = $(this).data('indikator')
      var deskripsi = $(this).data('deskripsi')
      var nama_kompetensi = $(this).data('nama_kompetensi')
      // document.getElementsByName("nama_kompetensi").val = nama_kompetensi;
      // document.getElementById("editForm").action = '/dinas/'+id;
      var APP_URL = {!! json_encode(url('/manajerial')) !!}
      document.getElementById("editForm").action = APP_URL+'/'+id;
      $('.edit-nama').selectpicker('val', nama_kompetensi);  
      // // $('.edit-nama').val(nama_kompetensi);
      // $('.edit-nama').selectpicker('render');
      $('.edit-id').val(id);
      $('.edit-level').val(level);
      $('.edit-indikator').val(indikator);
      $('.edit-deskripsi').val(deskripsi);
      

    });
    $(document).on('click', '.btn-simpan', function() {
      $('.edit-nama').selectpicker().attr('disabled', false);
    });
  })
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush