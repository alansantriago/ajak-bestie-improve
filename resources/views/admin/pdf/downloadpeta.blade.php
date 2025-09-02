@php
    $orientasi = $orientasi ?? 'landscape';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Peta Jabatan - {{ $namaopd }}</title>
    <style>
        @if ($orientasi == 'potrait')
        @page {
            size: A4 portrait;
            margin: 15px;
        }
        @else
        @page {
            size: A4 landscape;
            margin: 15px;
        }
        @endif

        html, body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 8px;
            line-height: 1.1; 
        }
        
        .printable-container {
            width: 100%;
            page-break-inside: avoid;
        }
        
        .scaling-wrapper {
            transform: scale(0.25); 
            transform-origin: top center;
            width: 400%; 
            margin-left: 0%;
        }

        h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #32325d;
            font-size: 12px;
            page-break-after: avoid;
        }
        
        .chart-viewport { overflow: visible; width: 100%; }
        .chart-container { 
            padding: 0; 
            text-align: center; 
        }
        .org-chart { text-align: center; display: inline-block; }
        .org-chart ul, .org-chart li { list-style: none; margin: 0; padding: 0; position: relative; page-break-inside: avoid; }
        .org-chart ul { display: table; padding-top: 20px; margin: 0 auto; border-spacing: 0; }
        .org-chart li { 
            display: table-cell; 
            position: relative; 
            vertical-align: top; 
            padding: 0 3px; 
        }

        .org-chart li::before, 
        .org-chart li::after { content: ''; position: absolute; top: 0; right: 50%; width: 50%; height: 20px; border-top: 1px solid #000; }
        .org-chart li::after { left: 50%; right: auto; }

        .node-card::before { 
            content: ''; 
            position: absolute; 
            top: -20px; 
            left: 50%; 
            transform: translateX(-50%); 
            height: 20px; 
            width: 1px;
            background-color: #000;
        }
        .node-card.has-children::after { 
            content: ''; 
            position: absolute; 
            left: 50%; 
            transform: translateX(-50%); 
            height: 20px; 
            width: 1px;
            background-color: #000;
        }

        .org-chart li:only-child::after, .org-chart li:only-child::before { display: none; }
        .org-chart li:first-child::before, .org-chart li:last-child::after { border: 0 none; }
        .org-chart li:last-child::before { border-right: 1px solid #000; }
        .org-chart > ul > li::before, .org-chart > ul > li::after, .org-chart > ul > li > .node-card::before { display: none !important; }

        .node-card {
            width: 90px; display: inline-block; background-color: #fff; border: 1px solid #000;
            border-radius: 4px; position: relative; margin-top: 20px; page-break-inside: avoid;
        }
        
        .node-title {
            font-size: 7px; font-weight: 600; background-color: #414347; color: #fff; padding: 2px;
            border-top-left-radius: 4px; border-top-right-radius: 4px; overflow-wrap: break-word; 
            border-bottom: 1px solid #000;
        }

        .node-details {
            font-size: 7px; padding: 0 2px 2px 2px;
        }
        .node-details div { display: flex; justify-content: center; align-items: center; padding: 2px 0; }
        
        .non-struktural-card { width: 190px; margin-top: 18px; }

        .non-struktural-table .table {
            width: 100%; margin: 0; font-size: 7px; background-color: #fff;
            border-collapse: collapse; table-layout: fixed; 
        }

        .non-struktural-table .table th,
        .non-struktural-table .table td {
            padding: 2px; border: 1px solid #ccc; text-align: center; overflow-wrap: break-word; 
        }
        
        .non-struktural-table .table th:nth-child(1),
        .non-struktural-table .table td:nth-child(1) { width: 40%; }
        .non-struktural-table .table th:nth-child(2), .non-struktural-table .table td:nth-child(2),
        .non-struktural-table .table th:nth-child(3), .non-struktural-table .table td:nth-child(3),
        .non-struktural-table .table th:nth-child(4), .non-struktural-table .table td:nth-child(4),
        .non-struktural-table .table th:nth-child(5), .non-struktural-table .table td:nth-child(5) { width: 15%; }

        .non-struktural-table .table .text-left1 { text-align: left !important; background-color: #bfc0c1; color: #000; font-weight: bold; }
        .non-struktural-table .table .text-left { text-align: left !important; }
        .non-struktural-table .table thead { background-color: #414347; color: #fff; }
    </style>
</head>
<body>
    <div class="printable-container">
        <div class="scaling-wrapper">

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
    </div>
</body>
</html>

