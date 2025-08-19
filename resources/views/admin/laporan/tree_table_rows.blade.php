@php
    use Illuminate\Support\Str;
    $hasChildren = isset($data['tree']) && count($data['tree']) > 0;
    $indentation = ($level ?? 0) * 18;
    $rowId = $id ?? Str::slug($nama_jabatan);
@endphp
<tr class="tree-row" data-id="{{ $rowId }}" data-parent-id="{{ $parent_id ?? '' }}" data-level="{{ $level ?? 0 }}" @if(!empty($parent_id)) style="display:none" @endif>
	<td>
		<div class="d-flex align-items-center" style="padding-left: {{ $indentation }}px;">
			@if($hasChildren)
				<button class="btn btn-sm btn-link p-0 mr-2 tree-toggle" aria-label="Toggle children" data-id="{{ $rowId }}"><i class="fas fa-chevron-right"></i></button>
			@else
				<span class="mr-3" style="width:14px;display:inline-block;"></span>
			@endif
			<span class="font-weight-600">{{ $nama_jabatan }}</span>
			@if(isset($data['jenis_jabatan']) && $data['jenis_jabatan'] !== 'Struktural')
				<span class="badge badge-secondary ml-2">{{ $data['jenis_jabatan'] }}</span>
			@endif
		</div>
	</td>
	<td class="text-center">{{ $data['jenis_jabatan'] ?? '-' }}</td>
	<td class="text-center">{{ $data['kelas_jabatan'] ?? '-' }}</td>
	<td class="text-center">{{ $data['pegawai'] ?? '-' }}</td>
	<td class="text-center">{{ $data['tp_total'] ?? '-' }}</td>
	<td class="text-center">{{ $data['peg_total_diff'] ?? '-' }}</td>
</tr>
@if($hasChildren)
	@php
		$currentPrefix = $rowId;
		$children = $data['tree'];
	@endphp
	@foreach($children as $child_name => $child_data)
		@include('admin.laporan.tree_table_rows', [
			'nama_jabatan' => $child_name,
			'data' => $child_data,
			'level' => ($level ?? 0) + 1,
			'id' => $currentPrefix . '/' . \Illuminate\Support\Str::slug($child_name),
			'parent_id' => $rowId
		])
	@endforeach
@endif


