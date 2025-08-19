@foreach($children as $child_name => $child_data)
    <li>
        <span>{{ $child_name }}</span>
        <div class="extra-data">
            <span>{{ $child_data['pegawai'] }}</span>
            <span>{{ $child_data['tp_total'] }}</span>
            <span>{{ $child_data['peg_total_diff'] }}</span>
        </div>
        @if(count($child_data['tree']) > 0)
            <ul>
                @include('admin.laporan.detail1peta_child', ['children' => $child_data['tree']])
            </ul>
        @endif
    </li>
@endforeach
