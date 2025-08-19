{{-- resources/views/admin/laporan/peta_jabatan_row.blade.php --}}

@php
    $indentation = ($level ?? 0) * 30; // Jarak indentasi per level
    $rowClass = '';
    $icon = 'fa-user';
    if (isset($node['jenis_jabatan'])) {
        if ($node['jenis_jabatan'] === 'Struktural') {
            $rowClass = 'tr-struktural';
            $icon = 'fa-sitemap';
        } elseif ($node['jenis_jabatan'] === 'Fungsional') {
            $rowClass = 'tr-fungsional';
            $icon = 'fa-user-tie';
        }
    }
@endphp

<tr class="{{ $rowClass }}">
    <td style="padding-left: {{ $indentation }}px; text-align: left;">
        <i class="fas {{ $icon }} mr-2" style="opacity: 0.7;"></i>
        <strong>{{ $nama_jabatan }}</strong>
    </td>
    <td class="text-center">{{ $node['kelas_jabatan'] ?? '-' }}</td>
    <td class="text-center">{{ $node['pegawai'] }}</td>
    <td class="text-center">{{ $node['tp_total'] }}</td>
    <td class="text-center">{{ $node['peg_total_diff'] }}</td>
</tr>

{{-- Panggilan Rekursif untuk menampilkan anak-anaknya --}}
@if (count($node['tree']) > 0)
    @foreach ($node['tree'] as $child_name => $child_data)
        @include('admin.laporan.peta_jabatan_row', [
            'nama_jabatan' => $child_name,
            'node' => $child_data,
            'level' => ($level ?? 0) + 1
        ])
    @endforeach
@endif