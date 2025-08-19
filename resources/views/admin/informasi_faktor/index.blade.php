@extends('layouts.app', ['title' => __('Kelola Informasi Jabatan')])

@section('content')
@include('admin.header', ['halaman' => __('Kelola Informasi Jabatan')])
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Daftar Informasi Jabatan</h3>
            </div>
            {{-- <div class="col-4 text-right">
              <a href="/tambah-jabatan" class="btn btn-sm btn-primary p-2 btnTambah">Tambah Jabatan</a>
            </div> --}}

          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-6 text-center">
              @if (session()->has('success'))
              <div class="alert alert-info my-2" role="alert">
                <strong>{{ session('success') }}</strong>
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
                  <th class="text-center" scope="col">Nama Jabatan</th>
                  <th class="text-center" scope="col">Faktor 1</th>
                  <th class="text-center" scope="col">Faktor 2</th>
                  <th class="text-center" scope="col">Faktor 3</th>
                  <th class="text-center" scope="col">Faktor 4</th>
                  <th class="text-center" scope="col">Faktor 5</th>
                  <th class="text-center" scope="col">Faktor 6</th>
                  <th class="text-center" scope="col">Faktor 7</th>
                  <th class="text-center" scope="col">Faktor 8</th>
                  <th class="text-center" scope="col">Faktor 9</th>
                  <th class="text-center" scope="col">Kelas Jabatan</th>
                  <th class="text-right pr-6">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="col">1</th>
                  <th>Asisten Administrasi Umum</th>
                  <th class="text-center">175</th>
                  <th class="text-center">100</th>
                  <th class="text-center">450</th>
                  <th class="text-center">25</th>
                  <th class="text-center">30</th>
                  <th class="text-center">75</th>
                  <th class="text-center">310</th>
                  <th class="text-center">450</th>
                  <th class="text-center">450</th>
                  <th class="text-center">@php kelasjabatan((175+100+450+25+30+75+310+450+450))@endphp</th>
                  <th>
                    <div class="text-right">
                      <a href="#" class="btn btn-info btn-sm btnEdit" data-bs-toggle="modal"
                        data-bs-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th scope="col">2</th>
                  <th>Asisten Pemerintahan dan Kesejahteraan Rakyat</th>
                  <th class="text-center">175</th>
                  <th class="text-center">100</th>
                  <th class="text-center">450</th>
                  <th class="text-center">25</th>
                  <th class="text-center">30</th>
                  <th class="text-center">75</th>
                  <th class="text-center">310</th>
                  <th class="text-center">450</th>
                  <th class="text-center">450</th>
                  <th class="text-center">@php kelasjabatan(175+100+450+25+30+75+310+450+450)@endphp</th>
                  <th>
                    <div class="text-right">
                      <a href="#" class="btn btn-info btn-sm btnEdit" data-bs-toggle="modal"
                        data-bs-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th scope="col">3</th>
                  <th>Asisten Pemerintahan dan Kesejahteraan Rakyat</th>
                  <th class="text-center">175</th>
                  <th class="text-center">100</th>
                  <th class="text-center">450</th>
                  <th class="text-center">25</th>
                  <th class="text-center">30</th>
                  <th class="text-center">75</th>
                  <th class="text-center">310</th>
                  <th class="text-center">450</th>
                  <th class="text-center">450</th>
                  <th class="text-center">@php kelasjabatan((175+100+450+25+30+75+310+450+450))@endphp</th>
                  <th>
                    <div class="text-right">
                      <a href="#" class="btn btn-info btn-sm btnEdit" data-bs-toggle="modal"
                        data-bs-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h3 class="modal-title">Hapus Semua Data Informasi Faktor Jabatan?</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <form action="" name="deleteForm" id="deleteForm" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" id="id" class="deleteID">

                        <div class="modal-body">
                          <p>Yakin ingin menghapus informasi faktor <strong id="valuedinas"></strong> ?<br>Semua data
                            informasi faktor
                            jabatan tidak dapat dikembalikan!</p>
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
            {{ $jabatan->onEachSide(0)->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('admin.informasi_faktor.edit_index')

  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    $(document).ready(function(){
     
    $(document).on('click', '.btnDelete', function() {
            var id = $(this).data('id')
            var nama_dinas = $(this).data('nama_dinas')
            var APP_URL = {!! json_encode(url('/dinas')) !!}
            document.getElementById("deleteForm").action = APP_URL+'/'+id;
            // document.getElementById("deleteForm").action = '/dinas/'+id;
            $('.deleteID').val(id);
            $('#valuedinas').text(nama_dinas);
          })

          
    $(document).on('click', '.btnEdit', function() {
      var id = $(this).data('id')
      var nama_dinas = $(this).data('nama_dinas')
      // document.getElementById("editForm").action = '/dinas/'+id;
      var APP_URL = {!! json_encode(url('/dinas')) !!}
      document.getElementById("editForm").action = APP_URL+'/'+id;
      $('.edit-id').val(id)
      $('.edit-name').val(nama_dinas);
    })
  })
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush