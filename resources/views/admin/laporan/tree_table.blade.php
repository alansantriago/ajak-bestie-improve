<div class="card mt-4">
	<div class="card-header d-flex justify-content-between align-items-center">
		<h3 class="mb-0">Hierarki dalam Tabel</h3>
		<div>
			<button class="btn btn-sm btn-outline-secondary" id="expand-all">Expand All</button>
			<button class="btn btn-sm btn-outline-secondary" id="collapse-all">Collapse All</button>
		</div>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-sm mb-0">
				<thead class="thead-light">
					<tr>
						<th>Nama Jabatan</th>
						<th class="text-center">Jenis</th>
						<th class="text-center">Kelas</th>
						<th class="text-center">B</th>
						<th class="text-center">K</th>
						<th class="text-center">S</th>
					</tr>
				</thead>
				<tbody>
					@foreach($jabatan_hierarchy as $root_name => $root_data)
						@include('admin.laporan.tree_table_rows', [
							'nama_jabatan' => $root_name,
							'data' => $root_data,
							'level' => 0,
							'id' => \Illuminate\Support\Str::slug($root_name),
							'parent_id' => null
						])
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@push('css')
<style>
	.table .tree-row .fa-chevron-right { transition: transform .2s ease; }
	.table .tree-row.expanded .fa-chevron-right { transform: rotate(90deg); }
</style>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function(){
	function toggleChildren(rowId, expand){
		const children = Array.from(document.querySelectorAll('tr.tree-row[data-parent-id="' + rowId + '"]'));
		children.forEach(function(child){
			if(expand){
				child.style.display = '';
			} else {
				child.style.display = 'none';
			}
			const childId = child.getAttribute('data-id');
			if(!expand){
				child.classList.remove('expanded');
				toggleChildren(childId, false);
			}
		});
	}

	document.querySelectorAll('.tree-toggle').forEach(function(btn){
		btn.addEventListener('click', function(e){
			e.preventDefault();
			const rowId = this.dataset.id;
			const row = document.querySelector('tr.tree-row[data-id="' + rowId + '"]');
			const isExpanded = row.classList.toggle('expanded');
			toggleChildren(rowId, isExpanded);
		});
	});

	var expandAllBtn = document.getElementById('expand-all');
	if(expandAllBtn){
		expandAllBtn.addEventListener('click', function(){
			document.querySelectorAll('tr.tree-row').forEach(function(row){
				const id = row.getAttribute('data-id');
				const parent = row.getAttribute('data-parent-id');
				if(!parent){
					row.classList.add('expanded');
					toggleChildren(id, true);
				}
			});
		});
	}

	var collapseAllBtn = document.getElementById('collapse-all');
	if(collapseAllBtn){
		collapseAllBtn.addEventListener('click', function(){
			document.querySelectorAll('tr.tree-row').forEach(function(row){
				const id = row.getAttribute('data-id');
				const parent = row.getAttribute('data-parent-id');
				if(!parent){
					row.classList.remove('expanded');
					toggleChildren(id, false);
				} else {
					row.style.display = 'none';
					row.classList.remove('expanded');
				}
			});
		});
	}
});
</script>
@endpush


