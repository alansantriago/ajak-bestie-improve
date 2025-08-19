@extends('layouts.app', ['title' => __('Peta Jabatan')])

@section('content')
@include('admin.header', ['halaman' => __('Peta Jabatan')])
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Peta Jabatan</h3>
            </div>
            {{-- <div class="col-4 text-right">
              <a href="/laporan-informasi/{{ $index->kode_jabatan }}" target="_blank"
                class="btn btn-sm btn-primary p-2 btnTambah" data-bs-toggle="modal"
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

                  <th class="text-left col-1" onclick="showHideRow('hidden_row{{ $index->id }}');"><a
                      href="/detail_peta/{{ $index->id }}" target="_blank" class="btn btn-default btn-sm btnWord">Lihat
                      Peta</a>
                  </th>
                  {{-- <th class="text-left col-1" onclick="showHideRow('hidden_row{{ $index->id }}');"><a href="#"
                      class="btn btn-default btn-sm btnWord">Lihat
                      Peta</a>
                  </th> --}}
                  <th class="text-left" onclick="showHideRow('hidden_row{{ $index->id }}');"></th>
                  <th class=" text-dark" onclick="showHideRow('hidden_row{{ $index->id }}');">{{ $index->nama_dinas }}
                  </th>
                </tr>
              </thead>
              @endforeach
            </table>

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

  {{-- @include('admin.manajerial.edit') --}}
  @include('admin.analisis_jabatan.tambahChild')
  @include('admin.analisis_jabatan.tambah')

  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    $(document).ready(function(){
     
    
  })
  </script>
  <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
  @endpush