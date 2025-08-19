@extends('layouts.app', ['title' => __('Korelasi Jabatan | '.$kode_jabatan)])

@section('content')
@include('admin.header', ['halaman' => __('Korelasi Jabatan | '.$kode_jabatan)])

<div class="container-fluid mt--7">
  <div class="row justify-content-center">
    <div class="col-xl-12 order-xl-1 mb-3">
      {{-- Tugas Pokok Jabatan --}}
      <div class="card shadow mb-3">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="mx-auto mt-4">
              <h3 class="text-center">{{ __('Korelasi Jabatan '. $jabatan->datajabatan->nama_jabatan) }}</h3>
            </div>
          </div>
          <div class="justify-content-end mt-3 mr-4 text-right">
            <a id="rowAdder" href="#" class="btn btn-sm btn-primary p-2 btnTambah">Tambah Korelasi</a>
          </div>
        </div>

        <div class="card-body">
          @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @if ($errors->any())
          <div class="alert alert-danger my-2 text-center" role="alert">

            @foreach ($errors->all() as $error)

            <strong>{{ $error }}</strong><br>

            @endforeach

          </div>
          @endif
          @if (session('Errors'))
          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('Errors') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <form role="form" action="/analisis_korelasi/{{ $jabatan->kode_jabatan }}" method="POST">
            @method('PUT')
            @csrf
            <div class="table-responsive">
              <table class="table align-items-center table-flush table-bordered" id="customerList" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    {{-- <th scope="col">No</th> --}}
                    <th scope="col" class="text-center">Nama Jabatan</th>
                    <th scope="col" class="text-center">Unit Kerja</th>
                    <th scope="col" class="text-center">Deskripsi</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody id="newinput">
                  @php
                  // dd($beban_kerja[0]['jumlah_hasil']);
                  $i = 0 ;
                  @endphp


                  @if($korelasi->first() == NULL)
                  <tr id="row">

                    <th class="col-2 text-center">
                      <input type="text" name="nama_jabatan[]" id="nama_jabatan{{ ($i+1) }}"
                        class="form-control form-control-{{ $errors->has('nama_jabatan'.($i+1)) ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Nama Jabatan') }}" value="{{ old('nama_jabatan.'.($i+1)) }}" min="0"
                        required autofocus>
                    </th>
                    <th class="col-2 text-center">
                      <input type="text" name="unit_kerja[]" id="unit_kerja.{{ ($i+1) }}"
                        class="form-control form-control-{{ $errors->has('unit_kerja.'.($i+1)) ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Unit Kerja') }}" value="{{ old('unit_kerja.'.($i+1)) }}" min="0" required
                        autofocus>
                    </th>
                    <th class="col-3 text-center">
                      <textarea name="deskripsi[]" id="deskripsi{{ ($i+1) }}" cols="30" rows="3"
                        class="form-control form-control-{{ $errors->has('deskripsi'.($i+1)) ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Masukkan Deskripsi') }}" value="{{ old('deskripsi.'.($i+1)) }}"
                        required>{{ old('deskripsi.'.($i+1)) }}</textarea>
                    </th>

                    <th class="text-center col-1 "><a href="#" id="DeleteRow"
                        class="btn btn-danger text-white  btnTambah mx-auto">Delete</a>

                    </th>
                  </tr>

                  <?php $i++;?>
                  @else
                  @foreach ($korelasi as $index)
                  <tr id="row">
                    <th class="col-2 text-center">
                      <input type="text" name="nama_jabatan[]" id="nama_jabatan{{ ($i+1) }}"
                        class="form-control form-control-{{ $errors->has('nama_jabatan'.($i+1)) ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Nama Jabatan') }}"
                        value="{{ old('nama_jabatan.'.($i+1),$index->nama_jabatan) }}" min="0" required autofocus>
                    </th>
                    <th class="col-2 text-center">
                      <input type="text" name="unit_kerja[]" id="unit_kerja.{{ ($i+1) }}"
                        class="form-control form-control-{{ $errors->has('unit_kerja.'.($i+1)) ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Unit Kerja') }}"
                        value="{{ old('unit_kerja.'.($i+1),$index->unit_kerja) }}" min="0" required autofocus>
                    </th>
                    <th class="col-3 text-center">
                      <textarea name="deskripsi[]" id="deskripsi{{ ($i+1) }}" cols="30" rows="3"
                        class="form-control form-control-{{ $errors->has('deskripsi'.($i+1)) ? ' is-invalid' : '' }}"
                        placeholder="{{ __('Masukkan Deskripsi') }}"
                        value="{{ old('deskripsi.'.($i+1),$index->deskripsi) }}"
                        required>{{ old('deskripsi.'.($i+1),$index->deskripsi) }}</textarea>
                    </th>

                    <th class="text-center col-1">
                      <a href="#" id="DeleteRow" class="btn btn-danger text-white  btnTambah mx-auto">Delete</a>

                    </th>
                  </tr>

                  <?php $i++;?>
                  @endforeach

                  @endif

                </tbody>
              </table>
              <div class=" justify-content-center text-center mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>


      </div>
    </div>
  </div>
</div>


@include('layouts.footers.auth')

@endsection

@push('js')
<script>
  $("#rowAdder").click(function () {
            newRowAdd =
            // '<div class="table-responsive">'+
            // '<table class="table align-items-center table-flush table-bordered" id="customerList" style="width: 100%">'+
              // '<tbody>'+
            '<tr id="row">'+

              '<th class="col-2 text-center">'+
                '<input type="text" name="nama_jabatan[]" id="nama_jabatan{{ ($i+1) }}"'+
                'class="form-control form-control-{{ $errors->has("nama_jabatan".($i+1)) ? " is-invalid" : '' }}"'+
                'placeholder="{{ __("Nama Jabatan") }}" value="{{ old("nama_jabatan.".($i+1)) }}" min="0"'+
                'required autofocus>'+
                '</th>'+
              '<th class="col-2 text-center">'+
                  '<input type="text" name="unit_kerja[]" id="unit_kerja.{{ ($i+1) }}"'+
                  ' class="form-control form-control-{{ $errors->has("unit_kerja.".($i+1)) ? " is-invalid" : '' }}"'+
                  'placeholder="{{ __("Unit Kerja") }}" value="{{ old("unit_kerja.".($i+1)) }}" min="0" required '+
                  'autofocus>'+
              '</th>'+
              '<th class="col-3 text-center">'+
                    '<textarea name="deskripsi[]" id="deskripsi{{ ($i+1) }}" cols="30" rows="3"'+
                    'class="form-control form-control-{{ $errors->has("deskripsi".($i+1)) ? " is-invalid" : '' }}"'+
                    'placeholder="{{ __("Masukkan Deskripsi") }}" value="{{ old("deskripsi.".($i+1)) }}"'+
                    'required>{{ old("deskripsi.".($i+1)) }}</textarea>'+
                '</th>'+

                '<th class="text-left col-1 text-center"><a href="#" id="DeleteRow"'+
                      'class="btn btn-danger btnTambah mx-auto">Delete</a>'+
                  '</th>'+
              '</tr>'+
                      '<?php $i++;?>';
                    // '</tbody>'+
            // '</table>'+
          // '</div>';
 
            $('#newinput').append(newRowAdd);
        });
 
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        });
  $(document).ready(function(){
   
  })
</script>
<script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
@endpush