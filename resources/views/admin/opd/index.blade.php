@extends('layouts.app', ['title' => __('Kelola OPD')])

@push('css')

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('admin.header', ['halaman' => __('Kelola Organisasi Perangkat Daerah')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Organisasi Perangkat Daerah</h3>
                            </div>
                            <div class="col-4 text-right">
                                @if ($statusAktif == 0)
                                    <a href="#" class=" btn btn-sm btn-info btnTutup p-2"
                                        data-route="{{ route('opd.changeallstatus') }} "
                                        data-title="Mengaktifkan seluruh akses OPD ?">Buka Seluruh OPD</a>
                                @else
                                    <a href="#" class=" btn btn-sm btn-danger btnTutup p-2"
                                        data-route="{{ route('opd.changeallstatus') }} "
                                        data-title="Menutup seluruh akses OPD ?">Kunci Seluruh OPD</a>
                                @endif
                                <a href="" class="btn btn-sm btn-primary p-2 btnTambah" data-bs-toggle="modal"
                                    data-bs-target="#tambahModal">Tambah OPD</a>
                            </div>

                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 text-center">
                                @if (session()->has('success'))
                                    <div class="alert alert-info my-2" role="alert">
                                        <strong>{{ session('success') }}</strong>
                                    </div>
                                @elseif (session()->has('error'))
                                    <div class="alert alert-danger my-2" role="alert">
                                        <strong>{{ session('error') }}</strong>
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
                                        <th class="text-center">Kode</th>
                                        <th scope="col">Nama Organisasi Perangkat Daerah</th>
                                        <th scope="col">Status</th>
                                        <th class="text-right pr-6">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                $currentpage = request('page')?request('page'):1;
                $i = 1 + (10 * ( $currentpage- 1))
                @endphp --}}
                                    @foreach ($opd as $index)
                                        <tr>
                                            {{-- <th scope="col">
                    <?//php echo $i++; ?>
                  </th> --}}
                                            <th class="text-center">
                                                {{ $index->id }}
                                            </th>
                                            <th>
                                                {{ $index->nama_dinas }}
                                            </th>

                                            <th>
                                                <input class="toggle-class" type="checkbox"
                                                    {{ $index->status == 'buka' ? 'checked' : '' }}
                                                    data-id="{{ $index->id }}" data-toggle="toggle" data-on="Buka"
                                                    data-off="Kunci" data-onstyle="success" data-offstyle="danger"
                                                    data-size="sm">
                                            </th>
                                            <th>
                                                <div class="text-right">
                                                    <a href="#" class="btn btn-info btn-sm btnEdit"
                                                        data-id="{{ $index->id }}"
                                                        data-nama_dinas="{{ $index->nama_dinas }}" data-bs-toggle="modal"
                                                        data-bs-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm btnDelete"
                                                        data-id="{{ $index->id }}"
                                                        data-nama_dinas="{{ $index->nama_dinas }}" data-bs-toggle="modal"
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

                                                        <h3 class="modal-title">Hapus Organisasi Perangkat Daerah?</h3>
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
                                                            <p>Yakin ingin menghapus <strong id="valuedinas"></strong>
                                                                ?<br>Semua data seperti
                                                                data jabatan, inputan dan semua yang berhubungan akan
                                                                dihapus.</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
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
                            {{ $opd->onEachSide(0)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.opd.edit')
        @include('admin.opd.tambah')

        @include('layouts.footers.auth')

    @endsection

    @push('js')
        <script>
            let removeBtns = document.querySelectorAll('.btnTutup');
            removeBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();

                    const datatitle = e.target.getAttribute('data-title');
                    const route = e.target.getAttribute('data-route');

                    Swal.fire({
                        title: datatitle,
                        text: "Seluruh status untuk OPD akan berubah !",
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
                var status = $(this).prop('checked') == true ? "buka" : "kunci";
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: '{{ route('opd.changestatus') }}',
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
            $(document).ready(function() {

                $(document).on('click', '.btnDelete', function() {
                    var id = $(this).data('id')
                    var nama_dinas = $(this).data('nama_dinas')
                    var APP_URL = {!! json_encode(url('/dinas')) !!}
                    document.getElementById("deleteForm").action = APP_URL + '/' + id;
                    // document.getElementById("deleteForm").action = '/dinas/'+id;
                    $('.deleteID').val(id);
                    $('#valuedinas').text(nama_dinas);
                })
                $(document).on('click', '.btnEdit', function() {
                    var id = $(this).data('id')
                    var nama_dinas = $(this).data('nama_dinas')
                    // document.getElementById("editForm").action = '/dinas/'+id;
                    var APP_URL = {!! json_encode(url('/dinas')) !!}
                    document.getElementById("editForm").action = APP_URL + '/' + id;
                    $('.edit-id').val(id)
                    $('.edit-name').val(nama_dinas);
                })
            })
        </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    @endpush
