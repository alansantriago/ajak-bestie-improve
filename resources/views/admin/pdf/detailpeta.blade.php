<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Peta Jabatan - {{ $namaopd }}</title>
    <style>
        /* --- PENGATURAN DASAR & PRINT --- */
        .printable-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            page-break-inside: avoid;
        }

        .chart-viewport {
                width: 100%; /* <-- TAMBAHKAN ATAU PASTIKAN BARIS INI ADA */
                overflow: visible;
                page-break-inside: avoid;

        @page {
            size: A4 landscape; /* Mengatur halaman ke A4 landscape */
            margin: 20px;
        }

        html, body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0; /* Dihapus padding agar konten bisa full-width */
            font-size: 11px; /* Sedikit diperkecil untuk memuat lebih banyak konten */
            line-height: 1.3;
            width: 100%; /* Memastikan body mengisi area cetak */
        }

        h2 {
            width: max-content; /* Membuat lebar h2 pas dengan teksnya */
            margin-left: auto;   /* Margin kiri otomatis */
            margin-right: auto;  /* Margin kanan otomatis */

            /* Properti lain tetap sama */
            margin-bottom: 1.5rem;
            color: #32325d;
            font-size: 16px;
            font-weight: 600;
            page-break-after: avoid;
        }

        /* --- CONTAINER UTAMA --- */
        .chart-viewport {
            overflow: visible;
            page-break-inside: avoid;
        }
        
        .chart-container {
            padding: 0; /* Padding dihilangkan agar chart lebih lebar */
        }
        
        .org-chart {
            text-align: center;
            display: inline-block;
            page-break-inside: avoid;
            width: 100%; /* Memastikan chart menggunakan lebar penuh */
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

        /* --- LAYOUT & GARIS PENGHUBUNG --- */
        .org-chart ul {
            display: table;
            padding-top: 24px;
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
            padding: 0 5px; /* Padding dikurangi agar lebih rapat */
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
            border-top: 1px solid #000;
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
            border-left: 1px solid #000;
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
            border-right: 1px solid #000;
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

        /* Garis turun dari induk ke anak */
        .node-card.has-children::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            height: 25px; 
            border-left: 1px solid #000;
        }

        /* --- DESAIN KARTU (STRUKTURAL) --- */
        .node-card {
            display: inline-block;
            background-color: #fff;
            border: 1px solid #000;
            border-radius: 6px;
            box-shadow: none; /* Dihilangkan agar lebih simpel saat print */
            position: relative;
            margin-top: 25px;
            z-index: 1;
            min-width: 180px; /* Diperkecil agar lebih muat */
            max-width: 250px;
            page-break-inside: avoid;
        }
        
        .node-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 10px;
            background-color: #f7fafc;
            border-bottom: 1px solid #000;
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
            background-color: #414347;
            color: #ffffff;
            padding: 8px 10px;
            word-wrap: break-word;
            line-height: 1.3;
        }
        
        .node-details {
            padding: 0 8px;
            font-size: 10px;
            border-top: 2px solid #000;
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

        /* --- MODIFIKASI UNTUK NON-STRUKTURAL --- */
        /* Menghilangkan gaya 'card' dan hanya menyisakan tabelnya saja */
        .non-struktural-card {
            background-color: transparent;
            border: none;
            box-shadow: none;
            width: 100%; /* Menggunakan lebar penuh dari container li */
            min-width: initial; /* Reset min-width */
            max-width: initial; /* Reset max-width */
            padding: 0;
            margin-top: 23px;
            page-break-inside: avoid;
        }
        
        /* Menghilangkan header khusus non-struktural */
        .non-struktural-card .node-header {
            display: none;
        }

        /* Mengatur agar tabel non-struktural tidak memiliki padding ekstra */
        .non-struktural-table {
            max-height: none;
            overflow: visible;
            padding: 0;
        }

        /* .non-struktural-card::before {
            display: none;
        } */
        
        .non-struktural-table .table {
            font-size: 9px;
            margin: 0;
            background-color: #fff;
            width: 100%;
            border: 1px solid #000; 
            /* Tambahkan border luar untuk tabel */
        }
        
        .non-struktural-table .table th,
        .non-struktural-table .table td {
            padding: 5px 6px;
            white-space: normal;
            /* word-break: break-word; */
            border: 1px solid #000;
            text-align: center;
        }
        
        .non-struktural-table .table .text-left1{
            text-align: left !important;
            background-color: #bfc0c1;
        }

        .non-struktural-table .table .text-left{
            text-align: left !important;
        }

        /* --- ELEMEN TABEL UMUM --- */
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
            background-color: #414347; 
            font-weight: 600;
            color: #ffffff;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }

        /* --- PENGATURAN KHUSUS PRINT --- */
        @media print {
            body {
                font-size: 10px; /* Ukuran font lebih kecil saat print */
                -webkit-print-color-adjust: exact; /* Memaksa print warna background di Chrome */
                print-color-adjust: exact; /* Standar */
            }
            .node-card {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }
            h2 {
                font-size: 14pt;
            }
            .non-struktural-table .table {
                font-size: 8px;
            }
        }
    }
    </style>
</head>
<body>
    {{-- Bungkus baru untuk menjaga judul dan konten tetap bersama --}}
    <div class="printable-container"> 
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
    </div>
</body>
</html>