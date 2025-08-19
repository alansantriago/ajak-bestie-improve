@extends('layouts.app', ['title' => __('Biodata Jabatan Jabatan | ' . $kode_jabatan)])

@section('content')
    @include('admin.header', ['halaman' => __('Biodata Jabatan | ' . $kode_jabatan)])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-12 order-xl-1 mb-3">

                <div class="card shadow mb-3">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="mx-auto mt-4">
                                <h3 class="text-center">
                                    {{ __('Biodata Pegawai Jabatan ' . $jabatan->datajabatan->nama_jabatan) }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i> <b>Jika ada 1 bagian yang kosong pada 1 Biodata
                                maka biodata tersebut otomatis terhapus !!</b>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger my-2 text-center" role="alert">
                                @foreach ($errors->all() as $error)
                                    <strong>{{ $error }}</strong><br>
                                @endforeach
                            </div>
                        @endif
                        @if (session('Errors'))
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                {{ session('Errors') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form role="form" action ="{{ route('biodata_jabatan.update', [$jabatan->kode_jabatan]) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            @php
                                $i = 0;
                                $tp_total = 0;
                            @endphp


                            @if ($jabatan->total_beban_kerja != null)
                                @php
                                    $tp_total += $jabatan->total_beban_kerja;
                                @endphp
                            @else
                                @foreach ($jabatan->data_beban_kerja as $beban)
                                    @php
                                        $tp_total += ($beban->penyelesaian / 1250) * $beban->jumlah_hasil;
                                    @endphp
                                @endforeach
                            @endif
                            @php $index = 0; @endphp
                            <div class="row justify-content-center text-center">
                                {{-- Jika biodata kosong --}}
                                @if ($biodata->isEmpty())
                                    @for ($i = 0; $i < round($tp_total); $i++)
                                        @include('admin.biodata_jabatan.biodata-form', [
                                            'index' => $i,
                                            'data' => null,
                                            'required' => $i === 0,
                                        ])
                                    @endfor
                                @else
                                    {{-- Jika ada data biodata --}}
                                    @foreach ($biodata as $data)
                                        @include('admin.biodata_jabatan.biodata-form', [
                                            'index' => $loop->index,
                                            'data' => $data,
                                            'required' => $loop->first,
                                        ])
                                    @endforeach

                                    {{-- Tambahkan form kosong jika jumlah biodata kurang dari total --}}
                                    @for ($i = $biodata->count(); $i < round($tp_total); $i++)
                                        @include('admin.biodata_jabatan.biodata-form', [
                                            'index' => $i,
                                            'data' => null,
                                            'required' => $i === 0,
                                        ])
                                    @endfor
                                @endif
                            </div>

                            <div class=" justify-content-center text-center mt-3">
                                @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                                    <a href="{{ route('biodata_jabatan.create', $jabatan->kode_jabatan) }}" target="_blank"
                                        class="btn btn-info">Penambahan Biodata</a>
                                @endif
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h3 class="modal-title">Hapus Biodata Jabatan?</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="" name="deleteForm" id="deleteForm" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" id="id" class="deleteID">

                        <div class="modal-body">
                            <p>Yakin ingin menghapus <strong id="valuenama"></strong> dengan NIP <strong id="valuenip"></strong> ?<br>Biodata Jabatan akan
                                dihapus dan tidak bisa dikembalikan.</p>
                        </div>
                        <div class=" modal-footer justify-content-center">
                            <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')

    @endsection

    @push('js')
        <script>
            $(document).ready(function() {

                $(document).on('click', '.btnDelete', function() {
                    var nip = $(this).data('nip')
                    var nama = $(this).data('nama')
                    var index = $(this).data('nama')
                    var id = $(this).data('id')
                    const route = $(this).data('route')
                    // const route = this.getAttribute("route");
                    const deleteForm = document.getElementById("deleteForm");
                    deleteForm.action = route;
                    // document.getElementById("deleteForm").action = '/dinas/'+id;
                    $('.deleteID').val(id);
                    $('#valuenama').text(nama);
                    $('#valuenip').text(nip);
                });

            })
        </script>
        <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
    @endpush
