<li>
    {{-- KUNCI PERUBAHAN: Tambahkan class 'has-children' jika ada anak --}}
    <div class="node-card {{ (count($data['tree']) > 0) ? 'has-children' : '' }}">
        <div class="node-header">
            <div class="node-type">{{ $data['jenis_jabatan'] ?? 'Struktural' }}</div>
        </div>
        <div class="node-title">{{ $nama_jabatan }}</div>
        <div class="node-details">
            <div><span class="detail-value">Kelas {{ $data['kelas_jabatan'] ?? '-' }}</span></div>
        </div>
    </div>

    @if(count($data['tree']) > 0)
        @php
            $struktural_children = [];
            $non_struktural_children = [];
            foreach ($data['tree'] as $child_name => $child_data) {
                if (isset($child_data['jenis_jabatan']) && $child_data['jenis_jabatan'] === 'Struktural') {
                    $struktural_children[$child_name] = $child_data;
                } else {
                    $non_struktural_children[$child_name] = $child_data;
                }
            }
        @endphp

        <ul>
            @foreach ($struktural_children as $child_name => $child_data)
                @include('admin.laporan.peta_jabatan_node', [
                    'nama_jabatan' => $child_name,
                    'data' => $child_data,
                    'level' => ($level ?? 0) + 1
                ])
            @endforeach

            @if(count($non_struktural_children) > 0)
                <li>
                    <div class="node-card non-struktural-card">
                        <!-- <div class="node-header">
                            <div class="node-type"></div>
                        </div> -->
                        <div class="non-struktural-table">
                            <table class="table table-sm mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama Jabatan</th>
                                        <th class="text-center">KLS</th>
                                        <th class="text-center">B</th>
                                        <th class="text-center">K</th>
                                        <th class="text-center">S</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $jenisToRows = [];
                                        foreach ($non_struktural_children as $nsName => $nsData) {
                                            $jenis = $nsData['jenis_jabatan'] ?? 'Lainnya';
                                            if (!isset($jenisToRows[$jenis])) {
                                                $jenisToRows[$jenis] = [];
                                            }
                                            $jenisToRows[$jenis][$nsName] = $nsData;
                                        }

                                        // Urutkan jenis agar Fungsional muncul lebih dulu, lalu Pelaksana, sisanya menyusul
                                        $orderedJenis = ['Fungsional', 'Pelaksana'];
                                        $grouped = [];
                                        foreach ($orderedJenis as $j) {
                                            if (isset($jenisToRows[$j])) {
                                                $grouped[$j] = $jenisToRows[$j];
                                                unset($jenisToRows[$j]);
                                            }
                                        }
                                        foreach ($jenisToRows as $j => $rows) {
                                            $grouped[$j] = $rows;
                                        }
                                    @endphp

                                    @foreach ($grouped as $jenis => $rows)
                                        <tr>
                                            <th colspan="5" class="text-left">{{ strtoupper($jenis) }}</th>
                                        </tr>
                                        @foreach ($rows as $child_name => $child_data)
                                            <tr>
                                                <td class="text-left">{{ $child_name }}</td>
                                                <td class="text-center">{{ $child_data['kelas_jabatan'] ?? '-' }}</td>
                                                <td class="text-center">{{ $child_data['pegawai'] ?? '-' }}</td>
                                                <td class="text-center">{{ $child_data['tp_total'] ?? '-' }}</td>
                                                <td class="text-center">{{ $child_data['peg_total_diff'] ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    @endif
</li>