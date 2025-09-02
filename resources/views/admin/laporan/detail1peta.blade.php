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
                                    <!-- Tombol Cetak (Untuk Preview di Tab Baru) -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-print"></i> Cetak PDF
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if (auth()->user()->role == 'bkd')
                                                <a class="dropdown-item" href="{{ route('bkd.cetakpetajabatan', ['id' => $dinas_id, 'orientasi' => 'landscape']) }}" target="_blank">Cetak Landscape</a>
                                                <a class="dropdown-item" href="{{ route('bkd.cetakpetajabatan', ['id' => $dinas_id, 'orientasi' => 'potrait']) }}" target="_blank">Cetak Potrait</a>
                                            @else
                                                <a class="dropdown-item" href="/cetak-peta/{{ $dinas_id }}?orientasi=landscape" target="_blank">Cetak Landscape</a>
                                                <a class="dropdown-item" href="/cetak-peta/{{ $dinas_id }}?orientasi=potrait" target="_blank">Cetak Potrait</a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Tombol Unduh Langsung -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-download"></i> Unduh PDF
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if (auth()->user()->role == 'bkd')
                                                <a class="dropdown-item" href="{{ route('bkd.peta.unduh', ['id' => $dinas_id, 'orientasi' => 'landscape']) }}">Unduh Landscape</a>
                                                <a class="dropdown-item" href="{{ route('bkd.peta.unduh', ['id' => $dinas_id, 'orientasi' => 'potrait']) }}">Unduh Potrait</a>
                                            @else
                                                <a class="dropdown-item" href="{{ route('peta.unduh', ['id' => $dinas_id, 'orientasi' => 'landscape']) }}">Unduh Landscape</a>
                                                <a class="dropdown-item" href="{{ route('peta.unduh', ['id' => $dinas_id, 'orientasi' => 'potrait']) }}">Unduh Potrait</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @if (!empty($jabatan_hierarchy))
                            <div class="chart-wrapper">
                                <div class="zoom-controls">
                                    <button id="pan-toggle" class="btn btn-light btn-icon-only rounded-circle" title="Aktifkan Mode Geser">
                                        <i class="fas fa-arrows-alt"></i>
                                    </button>
                                    <button id="zoom-in" class="btn btn-light btn-icon-only rounded-circle" title="Zoom In">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button id="zoom-out" class="btn btn-light btn-icon-only rounded-circle" title="Zoom Out">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button id="zoom-reset" class="btn btn-light btn-icon-only rounded-circle" title="Reset Zoom">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                
                                <div class="chart-viewport" id="chart-viewport">
                                    <div class="chart-container" id="chart-container">
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

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewport = document.getElementById('chart-viewport');
    const container = document.getElementById('chart-container');
    if (!viewport || !container) return;

    let scale = 1;
    const zoomInButton = document.getElementById('zoom-in');
    const zoomOutButton = document.getElementById('zoom-out');
    const zoomResetButton = document.getElementById('zoom-reset');

    const applyTransform = () => {
        container.style.transformOrigin = 'center center';
        container.style.transform = `scale(${scale})`;
    };
    zoomInButton.addEventListener('click', () => { scale = Math.min(2, scale + 0.1); applyTransform(); });
    zoomOutButton.addEventListener('click', () => { scale = Math.max(0.3, scale - 0.1); applyTransform(); });
    zoomResetButton.addEventListener('click', () => {
        scale = 1;
        applyTransform();
        viewport.scrollLeft = (container.scrollWidth - viewport.clientWidth) / 2;
        viewport.scrollTop = (container.scrollHeight - viewport.clientHeight) / 2;
    });

    const panToggleButton = document.getElementById('pan-toggle');
    let panModeActive = false;
    panToggleButton.addEventListener('click', () => {
        panModeActive = !panModeActive; 
        panToggleButton.classList.toggle('active', panModeActive);
        viewport.classList.toggle('pan-active', panModeActive);
    });

    let isPanning = false, startX, startY, scrollLeft, scrollTop;
    viewport.addEventListener('mousedown', (e) => {
        if (!panModeActive || e.button !== 0) return;
        isPanning = true;
        viewport.classList.add('is-panning');
        startX = e.pageX - viewport.offsetLeft;
        startY = e.pageY - viewport.offsetTop;
        scrollLeft = viewport.scrollLeft;
        scrollTop = viewport.scrollTop;
    });
    viewport.addEventListener('mouseleave', () => { if (!panModeActive) return; isPanning = false; viewport.classList.remove('is-panning'); });
    viewport.addEventListener('mouseup', () => { if (!panModeActive) return; isPanning = false; viewport.classList.remove('is-panning'); });
    viewport.addEventListener('mousemove', (e) => {
        if (!isPanning || !panModeActive) return;
        e.preventDefault();
        const x = e.pageX - viewport.offsetLeft, y = e.pageY - viewport.offsetTop;
        const walkX = (x - startX), walkY = (y - startY);
        viewport.scrollLeft = scrollLeft - walkX;
        viewport.scrollTop = scrollTop - walkY;
    });
});
</script>
@endpush
