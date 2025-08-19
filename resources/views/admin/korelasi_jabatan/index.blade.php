@extends('layouts.app', ['title' => __('Analisis Korelasi Jabatan')])

@section('content')
@include('admin.header', ['halaman' => __('Analisis Korelasi Jabatan')])
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Analisis Korelasi Jabatan</h3>
            </div>
            {{-- <div class="col-4 text-right">
              <a href="#" class="btn btn-sm btn-primary p-2 btnTambah" data-bs-toggle="modal"
                data-bs-target="#tambahModal">Tambah</a>
            </div> --}}

          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-6 text-center">
              @if (session()->has('Success'))
              <div class="alert alert-info my-2" role="alert">
                <strong>{{ session('Success') }}</strong>
              </div>
              @endif
              @if (session()->has('Errors'))
              <div class="alert alert-danger my-2" role="alert">
                <strong>{{ session('Errors') }}</strong>
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger my-2" role="alert">

                @foreach ($errors->all() as $error)

                <strong>{{ $error }}</strong><br>

                @endforeach

              </div>
              @endif
            </div>
          </div>
        </div>
        <script type="text/javascript">
          function showHideRow(row) {
              $("#" + row).toggle();
          }
        </script>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover table-bordered" id="customerList"
              style="width: 100%">
              @foreach ($opd as $index)
              <thead class="table-default parent" data-child="{{ $index->id }}">
                <tr>
                  <th class="text-left col-1" onclick="showHideRow('hidden_row{{ $index->id }}');"><a href="#"
                      class="btn btn-dark btn-sm btnWord">Expand</a>
                  <th class=" text-dark py-3" onclick="showHideRow('hidden_row{{ $index->id }}');">{{ $index->nama_dinas
                    }}
                  </th>
                  <th class="text-right pr-6" onclick="showHideRow('hidden_row{{ $index->id }}');"></th>
                </tr>
              </thead>
              <tbody id="hidden_row{{ $index->id }}" class="hidden_row table table-hover" style="display: none;">
                @php
                $id_opd =$index->id;
                $nama_opd =$index->nama_dinas;
                if($index->id == 1){ $tingkatawal = 0; }else{ $tingkatawal = 1; };

                $hubunganjabatan = hubunganjabatan($index->id,$tingkatawal );
                // dd($hubunganjabatan);
                @endphp
                @if ($hubunganjabatan->first() == NULL)
                <tr>
                  <th colspan="4" class="text-center alert alert-danger"><strong>TIDAK ADA DATA</strong></th>
                </tr>
                @endif
                @foreach($hubunganjabatan as $index)
                <tr>
                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-primary">
                    <span class="fa fa-user"></span> </span><b>{{ $index->datajabatan->nama_jabatan }}</b>
                  </th>
                  <th>
                    <div class="text-right">
                      <a href="/analisis_korelasi/{{ $index->kode_jabatan }}/edit" class="btn btn-info btn-sm"
                        data-id="{{ $index->kode_jabatan}}" data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}"><i
                          class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-id="{{ $index->kode_jabatan}}"
                        data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>
                @if ($index->data_parent != NULL)
                @foreach($index->data_parent as $index)
                @php
                $lvl2 = childjabatan($index->child_jabatan);
                // dd($lvl2);
                @endphp
                @foreach($lvl2 as $index)
                <tr>
                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-default">
                    &emsp;<span class="fa fa-chevron-circle-right"></span> {{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">
                      <a href="/analisis_korelasi/{{ $index->kode_jabatan }}/edit" class="btn btn-info btn-sm"
                        data-id="{{ $index->kode_jabatan}}" data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}"><i
                          class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-id="{{ $index->kode_jabatan}}"
                        data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>
                @if ($index->data_parent != NULL)
                @foreach($index->data_parent as $index)
                @php
                $lvl3 = childjabatan($index->child_jabatan);
                // dd($lvl2);
                @endphp
                @foreach($lvl3 as $index)
                <tr>

                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-dark">
                    &emsp;&emsp;<span class="fa fa-arrow-right"></span> {{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">
                      <a href="/analisis_korelasi/{{ $index->kode_jabatan }}/edit" class="btn btn-info btn-sm"
                        data-id="{{ $index->kode_jabatan}}" data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}"><i
                          class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-id="{{ $index->kode_jabatan}}"
                        data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>
                @if ($index->data_parent != NULL)
                @foreach($index->data_parent as $index)
                @php
                $lvl4 = childjabatan($index->child_jabatan);
                // dd($lvl2);
                @endphp
                @foreach($lvl4 as $index)
                <tr>

                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-black">
                    &emsp;&emsp;&emsp;<span class="fa fa-chevron-right"></span> {{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">
                      <a href="/analisis_korelasi/{{ $index->kode_jabatan }}/edit" class="btn btn-info btn-sm"
                        data-id="{{ $index->kode_jabatan}}" data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}"><i
                          class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-id="{{ $index->kode_jabatan}}"
                        data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>
                @if ($index->data_parent != NULL)
                @foreach($index->data_parent as $index)
                @php
                $lvl5 = childjabatan($index->child_jabatan);
                // dd($lvl2);
                @endphp
                @foreach($lvl5 as $index)
                <tr>

                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-black">
                    &emsp;&emsp;&emsp;&emsp;&emsp;{{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">
                      <a href="/analisis_korelasi/{{ $index->kode_jabatan }}/edit" class="btn btn-info btn-sm"
                        data-id="{{ $index->kode_jabatan}}" data-nama_dinas="{{ $index->datajabatan->nama_jabatan }}"><i
                          class="fa fa-edit"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-sm btnDelete" data-id="{{ $index->kode_jabatan }}"
                        data-nama_dinas="{{ $index->datajabatan->nama_jabatan}}" data-bs-toggle="modal"
                        data-bs-target="#deleteModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                  </th>
                </tr>
                @endforeach
                @endforeach
                @endif
                @endforeach
                @endforeach
                @endif
                @endforeach
                @endforeach
                @endif
                @endforeach
                @endforeach
                @endif
                @endforeach


                <?php endforeach; ?>

              </tbody>
            </table>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default"
              aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                  <div class="modal-header">

                    <h3 class="modal-title">Hapus Data Korelasi ?</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <form action="" name="deleteForm" id="deleteForm" method="POST">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="id" id="id" class="deleteID">

                    <div class="modal-body">
                      <p>Yakin ingin menghapus <strong id="valuedinas"></strong> ?<br>Semua data beban kerja akan
                        dihapus dan tidak bisa dikembalikan.</p>
                    </div>
                    <div class=" modal-footer justify-content-center">
                      <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-center">
            {{ $opd->onEachSide(0)->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    $(document).ready(function(){
      
    $(document).on('click', '.btnDelete', function() {
            var id = $(this).data('id')
            var nama_dinas = $(this).data('nama_dinas')
            var APP_URL = {!! json_encode(url('/analisis_korelasi')) !!}
            document.getElementById("deleteForm").action = APP_URL+'/'+id;
            // document.getElementById("deleteForm").action = '/dinas/'+id;
            $('.deleteID').val(id);
            $('#valuedinas').text(nama_dinas);
          });
          
  })
  </script>
  <script>
    $(window).on('load', function() {
    if(<?php echo auth()->user()->role == 'user' ?>){
        showHideRow("hidden_row"+<?php $id = $opd->first();
        echo $id->id ?>);
       }
  })
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush