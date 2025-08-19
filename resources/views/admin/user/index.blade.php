@extends('layouts.app', ['title' => __('Kelola User Account')])

@push('css')
    <link href="{{ asset('assets') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- bootstrap toggle --}}
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush

@section('content')
    @include('admin.header', ['halaman' => __('Kelola User Account')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Daftar Akun</h3>
                            </div>
                            <div class="col-4 text-right">
                                @if ($statusAktif == 0)
                                    <a href="#" class=" btn btn-sm btn-info btnTutup p-2"
                                        data-route="{{ route('users.changeallstatus') }} "
                                        data-title="Mengaktifkan seluruh akses akun OPD ?">Buka Seluruh Akun
                                        OPD</a>
                                @else
                                    <a href="#" class=" btn btn-sm btn-danger btnTutup p-2"
                                        data-route="{{ route('users.changeallstatus') }} "
                                        data-title="Menutup seluruh akses akun OPD ?">Tutup Seluruh Akun
                                        OPD</a>
                                @endif
                                <a href="\create-user" class=" btn btn-sm btn-primary p-2 btnTambah">Tambah Akun</a>
                            </div>

                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 text-center">
                                <div id="notifSuccess" class="alert alert-info my-2" role="alert" style="display: none;">
                                    <strong id="text-success"></strong>
                                </div>
                                <div id="notifError" class="alert alert-danger my-2" role="alert" style="display: none;">
                                    <strong id="text-error"></strong>
                                </div>

                                @if (session()->has('success'))
                                    <div class="alert alert-info my-2" role="alert">
                                        <strong>{{ session('success') }}</strong>
                                    </div>
                                @endif
                                @if (session()->has('Errors'))
                                    <div class="alert alert-danger my-2" role="alert">
                                        <strong>{{ session('Errors') }}</strong>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger my-2" role="alert">

                                        @foreach ($errors->all() as $error)
                                            <strong>{{ $error }}</strong><br>
                                        @endforeach

                                    </div>
                                @endif

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
                                        <th scope="col">Nama Akun</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Hak Akses</th>
                                        <th scope="col">Status</th>
                                        <th class="text-right pr-6">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php

                                        $i = 1;
                                    @endphp
                                    @foreach ($akun as $index)
                                        <?php if (auth()->user()->id == $index->id) {
                                            continue;
                                        } ?>

                                        <tr>
                                            <th class="text-center">
                                                <?php echo $i++; ?>

                                            </th>
                                            {{-- <th class="text-center">
                    {{ $index->id }}
                  </th> --}}
                                            <th>
                                                {{ strtoupper($index->name) }}
                                            </th>
                                            <th>
                                                {{ $index->email }}
                                            </th>
                                            <th>
                                                @if ($index->role == 'user')
                                                    User Account
                                                @elseif ($index->role == 'admin')
                                                    Administrator
                                                @elseif ($index->role == 'superadmin')
                                                    Super Administrator
                                                @endif
                                                {{-- {{ $index->role }} --}}
                                            </th>
                                            <th>
                                                @if ($index->role == 'user')
                                                    @php
                                                        $dinas = cariaksesdinas($index->id);
                                                    @endphp
                                                    {{ $dinas->nama_dinas }}
                                                @else
                                                    Akses Administrator
                                                @endif
                                            </th>
                                            <th>
                                                <input class="toggle-class" type="checkbox"
                                                    {{ $index->status == 1 ? 'checked' : '' }}
                                                    data-id="{{ $index->id }}" data-toggle="toggle" data-on="Aktif"
                                                    data-off="Ditutup" data-onstyle="success" data-offstyle="danger"
                                                    data-size="sm">
                                            </th>

                                            <th>
                                                <div class="text-right">
                                                    <a href="#" class="btn btn-info btn-sm btnEdit"
                                                        data-id="{{ $index->id }}" data-name="{{ $index->name }}"
                                                        data-email="{{ $index->email }}" data-role="{{ $index->role }}"
                                                        @if ($index->role == 'user') data-akses ="{{ $dinas->id }}" @endif
                                                        data-bs-toggle="modal" data-bs-target="#editModal"><i
                                                            class="fa fa-edit"></i> Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm btnDelete"
                                                        data-id="{{ $index->id }}" data-email="{{ $index->email }}"
                                                        data-nama="{{ $index->name }}" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </th>
                                        </tr>


                                        <?php endforeach; ?>
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                            aria-labelledby="modal-default" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h3 class="modal-title">Hapus User Account?</h3>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form action="" name="deleteForm" id="deleteForm" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="id" id="id"
                                                            class="deleteID">

                                                        <div class="modal-body">
                                                            <p>Yakin ingin menghapus <strong id="valuenama"></strong>
                                                                dengan
                                                                Email <strong id="valueemail"></strong> ?<br>Anda akan
                                                                kehilangan akses
                                                                pada akun tersebut.</p>
                                                        </div>
                                                        <div class=" modal-footer justify-content-center">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-delete">Hapus</button>
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Batal</button>
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
                            {{ $akun->onEachSide(0)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.user.edit')
        {{-- @include('admin.opd.tambah') --}}

        @include('layouts.footers.auth')

    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            let removeBtns = document.querySelectorAll('.btnTutup');
            removeBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();

                    const datatitle = e.target.getAttribute('data-title');
                    const route = e.target.getAttribute('data-route');

                    Swal.fire({
                        title: datatitle,
                        text: "Seluruh status untuk akun OPD akan berubah !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            // Redirect to the specified route
                            window.location.href = route;
                        }
                    })
                })
            })
        </script>

        <script>
            $('.toggle-class').on('change', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: '{{ route('users.changestatus') }}',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        $('#notifSuccess').fadeIn();
                        // $('#notifDiv').css('background', 'green');
                        $('#text-success').text('Status Updated Successfully');
                        setTimeout(() => {
                            $('#notifSuccess').fadeOut();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        $('#notifError').fadeIn();
                        // $('#notifDiv').css('background', 'red');
                        $('#text-error').text('Failed to update status: ' + xhr.responseText);
                        setTimeout(() => {
                            $('#notifError').fadeOut();
                        }, 3000);
                    }
                });
            });
        </script>
        <script>
            function hakakses() {
                var role = document.getElementById("role").value
                if (role == 'user') {
                    document.getElementById("divakses").style.display = "block";
                } else {
                    document.getElementById("hak_akses").value = ''
                    document.getElementById("divakses").style.display = "none";
                };
            };
            $(document).ready(function() {
                hakakses();
                $(document).on('click', '.btnDelete', function() {
                    var id = $(this).data('id')
                    var nama = $(this).data('nama')
                    var email = $(this).data('email')
                    var APP_URL = {!! json_encode(url('/users')) !!}
                    document.getElementById("deleteForm").action = APP_URL + '/' + id;
                    // document.getElementById("deleteForm").action = '/dinas/'+id;
                    $('.deleteID').val(id);
                    $('#valuenama').text('"' + nama + '"');
                    $('#valueemail').text('"' + email + '"');
                })
                $(document).on('click', '.btnEdit', function() {
                    var id = $(this).data('id')
                    var name = $(this).data('name')
                    var email = $(this).data('email')
                    var role = $(this).data('role')
                    var hak_akses = $(this).data('akses')
                    // document.getElementById("editForm").action = '/dinas/'+id;
                    var APP_URL = {!! json_encode(url('/users')) !!}
                    document.getElementById("editForm").action = APP_URL + '/' + id;
                    $('.edit-id').val(id)
                    $('.edit-name').val(name);
                    $('.edit-email').val(email);
                    $('.edit-role').val(role);
                    if (role == 'user') {
                        document.getElementById("divakses").style.display = "block";
                    } else {
                        document.getElementById("hak_akses").value = ''
                        document.getElementById("divakses").style.display = "none";
                    };
                    $('.edit-hak_akses').val(hak_akses);
                })
            })
        </script>
        <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>

        <script src="{{ asset('assets') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    @endpush
