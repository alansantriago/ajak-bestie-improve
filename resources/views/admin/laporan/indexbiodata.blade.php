@extends('layouts.app', ['title' => __('Laporan Biodata Jabatan')])

@section('content')
    @include('admin.header', ['halaman' => __('Laporan Biodata Jabatan')])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Laporan Biodata Jabatan</h3>
                            </div>
                            <div class="col-4 text-right">
                                @if (auth()->check() && in_array(auth()->user()->role, ['superadmin', 'admin']))
                                    <a href="{{ route('all_biodata') }}" target="_blank"
                                        class="btn btn-sm btn-default p-2"><i class="fa-solid fa-file-excel"></i> Download
                                        Semua Biodata</a>
                                    <a href="{{ route('all_biodata', true) }}" target="_blank"
                                        class="btn btn-sm btn-default p-2 my-1"><i class="fa-solid fa-file-excel"></i>
                                        Download
                                        Semua Data Biodata</a>
                                @endif

                            </div>

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
                    <script type="text/javascript">
                        function showHideRow(row) {
                            $("#" + row).toggle();
                        }
                    </script>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-hover table-bordered" id="customerList"
                                style="width: 100%">
                                @foreach ($opd as $index)
                                    <thead class="table-default parent" data-child="{{ $index->id }}">
                                        <tr>

                                            <th class="text-left col-1"
                                                onclick="showHideRow('hidden_row{{ $index->id }}');"><a
                                                    href="/detail_rekap_biodata/{{ $index->id }}" target="_blank"
                                                    class="btn btn-dark btn-sm btnWord">Lihat
                                                </a>
                                            </th>

                                            <th class="text-left col-1">
                                                <a href="/cetak-laporan-biodata/{{ $index->id }}"
                                                    class="btn btn-sm btn-default "><i class="fa fa-file-excel"></i>
                                                    Download</a>
                                            </th>
                                            @if (auth()->check() && in_array(auth()->user()->role, ['superadmin', 'admin']))
                                                <th class="text-left col-1">
                                                    <a href="/cetak-laporan-biodata/{{ $index->id }}/{{ true }}"
                                                        class="btn btn-sm btn-default "><i class="fa fa-file-excel"></i>
                                                        Download Semua Data</a>
                                                </th>
                                            @endif
                                            {{-- <th class="text-left col-1" onclick="showHideRow('hidden_row{{ $index->id }}');"><a href="#"
                      class="btn btn-default btn-sm btnWord">Lihat
                      Peta</a>
                  </th> --}}
                                            <th class="text-left" onclick="showHideRow('hidden_row{{ $index->id }}');">
                                            </th>
                                            <th class=" text-dark" onclick="showHideRow('hidden_row{{ $index->id }}');">
                                                {{ $index->nama_dinas }}
                                            </th>
                                        </tr>
                                    </thead>
                                @endforeach
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

        {{-- @include('admin.manajerial.edit') --}}
        {{-- @include('admin.analisis_jabatan.tambahChild')
  @include('admin.analisis_jabatan.tambah') --}}

        @include('layouts.footers.auth')

    @endsection

    @push('js')
        <script>
            $(document).ready(function() {


            })
        </script>
        <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
    @endpush
