{{-- resources/views/admin/pdf/detailpeta.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Peta Jabatan - {{ $namaopd }}</title>
    <style>
        /* --- PENGATURAN DASAR --- */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #32325d;
            font-size: 18px;
            font-weight: 600;
            page-break-after: avoid;
        }

        /* --- PENGATURAN DASAR --- */
        .chart-viewport {
            height: auto;
            overflow: visible;
            border-radius: 8px;
            page-break-inside: avoid;
        }
        
        .chart-container {
            padding: 15px;
        }
        
        .org-chart {
            text-align: center;
            display: inline-block;
            page-break-inside: avoid;
        }
        
        .org-chart ul, .org-chart li {
            list-style: none;
            margin: 0;
            padding: 0;
            position: relative;
        }
        
        .org-chart > ul > li {
            padding: 0;
        }

        /* --- LAYOUT & GARIS PENGHUBUNG (TELAH DIPERBAIKI) --- */
        .org-chart ul {
            display: table;
            padding-top: 25px;
            margin: 0 auto;
            page-break-inside: avoid;
        }
        
        .org-chart > ul {
            border-spacing: 0;
        }
        
        .org-chart li {
            display: table-cell;
            position: relative;
            vertical-align: top;
            padding: 0 8px; 
            page-break-inside: avoid;
        }

        /* Garis horizontal */
        .org-chart li::before, 
        .org-chart li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            width: 50%;
            height: 25px;
            border-top: 2px solid #cbd5e0;
        }
        
        .org-chart li::after {
            left: 50%;
            right: auto;
        }

        /* Garis vertikal dari kartu ke garis horizontal di atasnya */
        .node-card::before {
            content: '';
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            height: 25px;
            border-left: 2px solid #cbd5e0;
        }

        /* Aturan untuk ujung-ujung garis */
        .org-chart li:only-child::after, 
        .org-chart li:only-child::before {
            display: none;
        }
        
        .org-chart li:first-child::before, .org-chart li:last-child::after { 
            border: 0 none; 
        }
        
        .org-chart li:last-child::before { 
            border-right: 2px solid #cbd5e0;
            border-radius: 0 5px 0 0;
        }
        
        .org-chart li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        /* Hapus Garis untuk node paling atas (root) */
        .org-chart > ul > li::before,
        .org-chart > ul > li::after {
            border-top: none !important;
        }
        
        .org-chart > ul > li > .node-card::before {
            display: none !important;
        }

        /* --- GARIS TURUN DARI INDUK KE ANAK (TELAH DIPERBAIKI) --- */
        .node-card.has-children::after {
            content: '';
            position: absolute;
            top: 100%; /* Mulai dari bawah kartu */
            left: 50%;
            transform: translateX(-50%);
            height: 25px; 
            border-left: 2px solid #cbd5e0;
        }

        /* --- DESAIN KARTU (UMUM) --- */
        .node-card {
            display: inline-block;
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            position: relative;
            margin-top: 23px;
            z-index: 1;
            min-width: 200px;
            max-width: 280px;
            page-break-inside: avoid;
        }
        
        .node-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 10px;
            background-color: #f7fafc;
            border-bottom: 1px solid #e9ecef;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }
        
        .node-type {
            font-size: 10px;
            font-weight: 600;
            color: #2dce89;
            text-transform: uppercase;
        }
        
        .node-title {
            font-size: 11px;
            font-weight: 600;
            color: #32325d;
            padding: 8px 10px;
            word-wrap: break-word;
            line-height: 1.3;
        }
        
        .node-details {
            padding: 0 10px 8px 10px;
            font-size: 10px;
            border-top: 1px solid #e9ecef;
        }
        
        .node-details div {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 6px 0;
        }
        .detail-value {
            font-weight: 600;
            color: #4a5568;
        }

        /* --- KARTU KHUSUS UNTUK TABEL NON-STRUKTURAL --- */
        .non-struktural-card {
            min-width: 500px;
            max-width: 700px;
            page-break-inside: avoid;
        }
        
        .non-struktural-card .node-type {
            color: #1171ef;
        }
        
        .non-struktural-table {
            max-height: none;
            overflow: visible;
            padding: 10px;
        }
        
        .non-struktural-table .table {
            font-size: 9px;
            margin: 0;
            background-color: #fff;
            table-layout: fixed;
            width: 100%;
        }
        
        .non-struktural-table .table th,
        .non-struktural-table .table td {
            padding: 6px 8px;
            white-space: normal;
            word-break: break-word;
            overflow-wrap: anywhere;
            border: 1px solid #dee2e6;
        }
        
        .non-struktural-table .table .text-left{
            text-align: left !important;
        }

        /* --- ELEMEN TABEL --- */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }
        
        .table-sm th, .table-sm td { 
            padding: 0.25rem; 
        }
        
        .mb-0 { 
            margin-bottom: 0 !important; 
        }
        
        .thead-light th { 
            background-color: #f8f9fa; 
            font-weight: 600;
            color: #495057;
        }
        
        .text-center { 
            text-align: center; 
        }
        
        .text-right { 
            text-align: right; 
        }
        
        .text-left { 
            text-align: left; 
        }
    </style>
</head>
<body>

    <h2>Peta Jabatan {{ $namaopd }}</h2>

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

</body>
</html>