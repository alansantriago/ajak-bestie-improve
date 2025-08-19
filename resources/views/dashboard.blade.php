@extends('layouts.app', ['title' => __('Dashboard')])

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row justify-content-center mt-3 ">
        @if((auth()->user()->role == 'superadmin')||(auth()->user()->role == 'admin'))
        <div class="col-xl-8 mb-5 mb-xl-0">
            @else
            <div class="col-xl-8 mb-5 mb-xl-0">
                @endif
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Data Beban Kerja Kosong</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="col-1">Kode Jabatan</th>
                                    <th scope="col" class="col-1">Nama Jabatan</th>
                                    <th scope="col" class="col-1">OPD</th>
                                    <th scope="col" class="col-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($bebankerja->first() == NULL)
                                <tr>
                                    <td colspan="4" class="text-center  bg-info">
                                        Tidak Ada Data Kosong
                                    </td>
                                </tr>
                                @endif
                                @foreach ($bebankerja as $index)
                                <tr>
                                    <th scope="row">
                                        {{ $index->kode_jabatan }}
                                    </th>
                                    <td>
                                        {{ $index->datajabatan->nama_jabatan }}
                                    </td>
                                    <td>{{ $index->detaildinas->nama_dinas }}
                                    </td>
                                    <td>
                                        <a href="/analisis_beban_kerja/{{ $index->kode_jabatan }}/edit"
                                            class="btn btn-info btn-sm" data-id="{{ $index->kode_jabatan}}"
                                            data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}"><i
                                                class="fa fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if((auth()->user()->role == 'superadmin')||(auth()->user()->role == 'admin'))
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Data Jabatan Tidak Lengkap</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="col-1">Nama Jabatan</th>
                                    <th scope="col" class="col-1">Jenis Jabatan</th>
                                    <th scope="col" class="col-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jabatan as $index)
                                <tr>
                                    <th scope="row">
                                        {{ $index->nama_jabatan }}
                                    </th>
                                    <td>
                                        {{ strtoupper($index->jenis_jabatan)}}
                                    </td>
                                    <td>
                                        <a href="jabatan/{{ $index->id }}/edit" class="btn btn-info btn-sm "><i
                                                class="fa fa-edit"></i>
                                            Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
        @include('layouts.footers.auth')
    </div>
    @endsection

    @push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    @endpush