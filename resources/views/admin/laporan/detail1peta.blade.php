@extends('layouts.app', ['title' => __('Peta Jabatan | '. $namaopd)])

@push('css')
    <link rel="stylesheet" href="{{ asset('css/org-chart.css') }}">
@endpush

@section('content')
    @include('admin.header', ['halaman' => __('Peta Jabatan | '. $namaopd)])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col"><h3 class="mb-0">Peta Jabatan {{ $namaopd }}</h3></div>
                            <div class="col text-right">
                                @if (!empty($jabatan_hierarchy))
                                    @if (auth()->user()->role == 'bkd')
                                        <a href="{{ route('bkd.cetakpetajabatan', $dinas_id) }}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> Download PDF</a>
                                    @else
                                        <a href="/cetak-peta/{{ $dinas_id }}" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> Download PDF</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @if (!empty($jabatan_hierarchy))
                            <div class="chart-viewport">
                                <div class="chart-container">
                                    <div class="org-chart">
                                        <ul>
                                            @foreach ($jabatan_hierarchy as $nama_jabatan => $data)
                                                @include('admin.laporan.peta_jabatan_node', [
                                                    'nama_jabatan' => $nama_jabatan,
                                                    'data' => $data,
                                                    'level' => 0
                                                ])
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning" role="alert">
                                <strong>Data Kosong!</strong> Belum ada data jabatan untuk ditampilkan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection