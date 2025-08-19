<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td colspan="7" align="center">
                    <h4>Daftar Nama Jabatan, Kelas Jabatan dan Pemangku Jabatan</h4>
                    <h4>Di Lingkungan Pemerintahan</h4>
                </td>
            </tr>
            <tr>
                <td colspan="7" align="center">
                    <h4>Di Lingkungan Pemerintahan</h4>
                </td>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">KODE JABATAN</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">NAMA JABATAN</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">UNIT ORGANISASI</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">KELAS JABATAN</th>
                <th style="text-align: center;" colspan="3">PEMANGKU JABATAN</th>
                @if ($allData)
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">TEMPAT LAHIR</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">TANGGAL LAHIR</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">MASA KERJA JABATAN</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">MASA KERJA KESELURUHAN</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">TAHUN DIANGKAT</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">TAHUN PENSIUN</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">JENJANG PENDIDIKAN</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">JURUSAN</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">RIWAYAT</th>
                @endif
            </tr>
            <tr>
                <th style="text-align: center; vertical-align: middle;">NAMA</th>
                <th style="text-align: center; vertical-align: middle;">NIP</th>
                <th style="text-align: center; vertical-align: middle;">Pangkat/Gol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Alldinas as $dinas)
                <tr>
                    <th colspan="7" align="left">
                        <h5><b>{{ $dinas->nama_dinas }}</b></h5>
                    </th>
                </tr>
                @php
                    $biodataJabatan = biodataByDinas($dinas->id);
                @endphp
                @foreach ($biodataJabatan as $index)
                    <tr>
                        <th>{{ $index->kode_jabatan }}</th>
                        <th>{{ $index->hubungan_jabatan_detail->datajabatan->nama_jabatan }}</th>
                        <th>
                            @if (stripos($dinas->nama_dinas, 'SMA') !== false ||
                                    stripos($dinas->nama_dinas, 'SMK') !== false ||
                                    stripos($dinas->nama_dinas, 'SLB') !== false)
                                {{ $dinas->nama_dinas }}
                            @else
                                @if (strtolower($index->hubungan_jabatan_detail->datajabatan->jenis_jabatan) == 'struktural')
                                    {{ preg_replace('/^kepala\s+/i', '', $index->hubungan_jabatan_detail->datajabatan->nama_unit) }}
                                @else
                                    @if ($index->hubungan_jabatan_detail->get_parent != null)
                                        {{ preg_replace('/^kepala\s+/i', '', $index->hubungan_jabatan_detail->get_parent->parent->datajabatan->nama_unit) }}
                                    @else
                                        {{ $dinas->nama_dinas }}
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
                        <th class="text-center">'{{ (string) $index->nip }}</th>
                        <th class="text-right">{{ $index->pangkat }}</th>
                        @if ($allData)
                            <th class="text-center">{{ $index->tempat_lahir }}</th>
                            <th class="text-center">{{ $index->tanggal_lahir }}</th>
                            <th class="text-center">{{ $index->masa_kerja_jabatan_tahun }} Tahun
                                {{ $index->masa_kerja_jabatan_bulan }} Bulan</th>
                            <th class="text-center">{{ $index->masa_kerja_keseluruhan_tahun }} Tahun
                                {{ $index->masa_kerja_keseluruhan_bulan }} Bulan</th>
                            <th class="text-center">{{ $index->tahun_diangkat }}</th>
                            <th class="text-center">{{ $index->tahun_pensiun }}</th>
                            <th class="text-center">{{ $index->jenjang_pendidikan }}</th>
                            <th class="text-center">{{ $index->jurusan }}</th>
                            <th class="text-center">{{ $index->riwayat }}</th>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
