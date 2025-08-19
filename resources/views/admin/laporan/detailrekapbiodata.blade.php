@extends('layouts.app', ['title' => __('Rekap Biodata Jabatan')])
@push('css')
    <link href="{{ asset('argon') }}/DataTables/datatables.min.css" rel="stylesheet">
@endpush

@section('content')
    @include('admin.header', ['halaman' => __('Rekap Biodata Jabatan')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Rekap Biodata {{ __('Di Lingkungan ' . $opd->nama_dinas) }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="/cetak-laporan-biodata/{{ $opd->id }}" class="btn btn-md btn-default p-2 "><i
                                        class="fa fa-file-excel"></i>
                                    Download</a>
                            </div>
                            {{-- <div class="col-4 text-right">
              <a href="#" class="btn btn-sm btn-primary p-2 btnTambah" data-bs-toggle="modal"
                data-bs-target="#tambahModal">Tambah</a>
            </div> --}}
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 text-center">
                                @if (session()->has('Success'))
                                    <div class="alert alert-info my-2" role="alert">
                                        <strong>{{ session('Success') }}</strong>
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
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive px-4">
                            <table class="table align-items-center table-flush table-hover table-bordered" id="example"
                                style="width: 100%">
                                <thead class="table-default parent">
                                    <tr>
                                        <th rowspan="2" align="center">KODE JABATAN</th>
                                        <th rowspan="2" align="center">NAMA JABATAN</th>
                                        <th rowspan="2" align="center">UNIT ORGANISASI</th>
                                        <th rowspan="2" align="center">KELAS JABATAN</th>
                                        <th class="text-center" colspan="3">PEMANGKU JABATAN</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">NAMA</th>
                                        <th class="text-center">NIP</th>
                                        <th class="text-center">Pangkat/Gol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($biodataJabatan as $index)
                                        <tr>
                                            <th>{{ $index->kode_jabatan }}</th>
                                            <th>{{ $index->hubungan_jabatan_detail->datajabatan->nama_jabatan }}</th>
                                            <th>
                                                @if (stripos($opd->nama_dinas, 'SMA') !== false || stripos($opd->nama_dinas, 'SMK') !== false || stripos($opd->nama_dinas, 'SLB') !== false)
                                                    {{ $opd->nama_dinas }}
                                                @else
                                                    @if (strtolower($index->hubungan_jabatan_detail->datajabatan->jenis_jabatan) == 'struktural')
                                                        {{ preg_replace('/^kepala\s+/i', '', $index->hubungan_jabatan_detail->datajabatan->nama_unit) }}
                                                    @else
                                                        @if ($index->hubungan_jabatan_detail->get_parent != null)
                                                            {{ preg_replace('/^kepala\s+/i', '', $index->hubungan_jabatan_detail->get_parent->parent->datajabatan->nama_unit) }}
                                                        @else
                                                            {{ $opd->nama_dinas }}
                                                        @endif
                                                    @endif
                                                @endif
                                            </th>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($index->hubungan_jabatan_detail->data_faktor as $data)
                                                @php
                                                    $total += $data->data_faktor->nilai;
                                                @endphp
                                            @endforeach
                                            <th class="text-center">{{ kelasjabatan2($total) }}</th>
                                            <th class="text-center">{{ $index->nama }}</th>
                                            <th class="text-center">{{ $index->nip }}</th>
                                            <th class="text-right">{{ $index->pangkat }}</th>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{-- {{ biodataByJabatan($dinas_id)->onEachSide(0)->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')

    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                new DataTable('#example', {
                    order: [
                        [0, 'asc']
                    ]
                });
            })
        </script>

        <script src="{{ asset('argon') }}/DataTables/datatables.min.js"></script>
    @endpush
