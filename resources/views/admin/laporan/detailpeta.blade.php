<ul class="tree mx-5">
    @foreach($jabatan_hierarchy as $nama_jabatan => $data)
    
    <li>
        <span>{{ $nama_jabatan }}</span>
        <div class="extra-data">
            <span>{{ $data['pegawai'] }}</span>
            <span>{{ $data['tp_total'] }}</span>
            <span>{{ $data['peg_total_diff'] }}</span>
        </div>
        @if(count($data['tree']) > 0)
        <ul>
            @include('admin.laporan.detail1peta_child', ['children' => $data['tree']])
        </ul>
        @endif
    </li>
    @endforeach
</ul>