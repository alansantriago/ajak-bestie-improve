@extends('layouts.app', ['title' => __('Analisis Jabatan')])

@section('content')
@include('admin.header', ['halaman' => __('Analisis jabatan')])
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <!-- Card header -->
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Analisis Jabatan</h3>
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
                      class="btn btn-dark btn-sm ">Expand</a></th>
                  <th class="text-left col-1"><a href="#" class="btn btn-primary btn-sm btnTambah"
                      data-id_opd="{{$index->id}}" data-nama_dinas="{{ $index->nama_dinas }}" @if($index->id == 1)
                      data-tingkat="0" @else data-tingkat="1" @endif
                      data-bs-toggle="modal" data-bs-target="#tambahModal" >Tambah</a></th>

                  {{-- <th class="text-left col-1"><a
                      href="/analisis_jabatan/create?jabatan={{ $index->nama_dinas }}&id={{ $index->id }}"
                      class="btn btn-primary btn-sm btnTambah">Tambah</a></th> --}}
                  <th class=" text-dark" onclick="showHideRow('hidden_row{{ $index->id }}');">{{ $index->nama_dinas }}
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
                    @if($index->datajabatan->jenis_jabatan == "Pelaksana") <h2><span
                        class="badge badge-xl bg-dark text-white">Pelaksana</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan == "Fungsional")
                    <h2><span class="badge badge-xl bg-warning">Fungsional</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan =="Struktural")
                    <a href="#" class="btn btn-primary btn-sm tambahChildModal" data-id_opd="{{$id_opd}}"
                      data-kode_jabatan="{{ $index->kode_jabatan }}" data-tingkat="{{ $index->tingkat +1}}"
                      data-nama_dinas="{{ $nama_opd }}" data-bs-toggle="modal"
                      data-bs-target="#tambahChildModal">Tambah</a>
                    @endif

                  </th>
                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-primary">
                    <span class="fa fa-user"></span> </span><b>{{ $index->datajabatan->nama_jabatan }}</b>
                  </th>
                  <th>
                    <div class="text-right">

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
                    @if($index->datajabatan->jenis_jabatan == "Pelaksana")
                    <h2><span class="badge badge-xl bg-dark text-white">Pelaksana</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan == "Fungsional")
                    <h2><span class="badge badge-xl bg-warning">Fungsional</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan =="Struktural")
                    <a href="#" class="btn btn-primary btn-sm tambahChildModal" data-id_opd="{{$id_opd}}"
                      data-kode_jabatan="{{ $index->kode_jabatan }}" data-tingkat="{{ $index->tingkat +1}}"
                      data-nama_dinas="{{ $nama_opd }}" data-bs-toggle="modal"
                      data-bs-target="#tambahChildModal">Tambah</a>
                    @endif
                  </th>
                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-default">
                    &emsp;<span class="fa fa-chevron-circle-right"></span> {{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">

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
                    @if($index->datajabatan->jenis_jabatan == "Pelaksana")
                    <h2><span class="badge badge-xl bg-dark text-white">Pelaksana</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan == "Fungsional")
                    <h2><span class="badge badge-xl bg-warning">Fungsional</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan =="Struktural")
                    <a href="#" class="btn btn-primary btn-sm tambahChildModal" data-id_opd="{{$id_opd}}"
                      data-kode_jabatan="{{ $index->kode_jabatan }}" data-tingkat="{{ $index->tingkat +1}}"
                      data-nama_dinas="{{ $nama_opd }}" data-bs-toggle="modal"
                      data-bs-target="#tambahChildModal">Tambah</a>
                    @endif
                  </th>
                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-dark">
                    &emsp;&emsp;<span class="fa fa-arrow-right"></span> {{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">

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
                    @if($index->datajabatan->jenis_jabatan == "Pelaksana")
                    <h2><span class="badge badge-xl bg-dark text-white">Pelaksana</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan == "Fungsional")
                    <h2><span class="badge badge-xl bg-warning">Fungsional</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan =="Struktural")
                    <a href="#" class="btn btn-primary btn-sm tambahChildModal" data-id_opd="{{$id_opd}}"
                      data-kode_jabatan="{{ $index->kode_jabatan }}" data-tingkat="{{ $index->tingkat +1}}"
                      data-nama_dinas="{{ $nama_opd }}" data-bs-toggle="modal"
                      data-bs-target="#tambahChildModal">Tambah</a>
                    @endif
                  </th>
                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-black">
                    &emsp;&emsp;&emsp;<span class="fa fa-chevron-right"></span> {{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">

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
                    @if($index->datajabatan->jenis_jabatan == "Pelaksana")
                    <h2><span class="badge badge-xl bg-dark text-white">Pelaksana</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan == "Fungsional")
                    <h2><span class="badge badge-xl bg-warning">Fungsional</span></h2>
                    @endif
                    @if($index->datajabatan->jenis_jabatan =="Struktural")
                    <a href="#" class="btn btn-primary btn-sm tambahChildModal" data-id_opd="{{$id_opd}}"
                      data-kode_jabatan="{{ $index->kode_jabatan }}" data-tingkat="{{ $index->tingkat +1}}"
                      data-nama_dinas="{{ $nama_opd }}" data-bs-toggle="modal"
                      data-bs-target="#tambahChildModal">Tambah</a>
                    @endif
                  </th>
                  <th class="text-left col-1">
                    {{ $index->kode_jabatan }}
                  </th>
                  <th class="text-black">
                    &emsp;&emsp;&emsp;&emsp;&emsp;{{ $index->datajabatan->nama_jabatan }}
                  </th>
                  <th>
                    <div class="text-right">

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

                    <h3 class="modal-title">Hapus Data Jabatan ?</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <form action="" name="deleteForm" id="deleteForm" method="POST">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="id" id="id" class="deleteID">

                    <div class="modal-body">
                      <p>Yakin ingin menghapus <strong id="valuedinas"></strong> ?<br>Semua data seperti
                        data jabatan, inputan dan semua yang berhubungan akan dihapus.</p>
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

  {{-- @include('admin.manajerial.edit') --}}
  @include('admin.analisis_jabatan.tambahChild')
  @include('admin.analisis_jabatan.tambah')

  @include('layouts.footers.auth')

  @endsection

  @push('js')
  <script>
    $(document).ready(function(){
      $('.jenis_jabatan').change(function(){
      if($(this).val() != ''){
        var select = $(this).attr("id");
        var value = $(this).val();
        var _token = $('input[name="_token"]').val();
        var selectt = document.getElementById('jabatan');

        $.ajax({
          url:"{{ route('datajabatan') }}",
          type:"POST",
          data:{select:select, value:value,_token:"{{ csrf_token() }}"},
          success:function(response){

            $('#jabatan').html('<option value="" selected disabled>Pilih Jabatan</option>');

            $.each(response.jabatan,function(index,val){
              $('#jabatan').append('<option value="' +val.id+  '" @if(old("jabatan")=="' +val.id+ '") selected @endif >' +val.nama_jabatan+ '</option>')
            });
            $('#jabatan').selectpicker('refresh');
          }

        })

      }
    });
    $('.jenis_jabatanchild').change(function(){
      if($(this).val() != ''){
        var select = $(this).attr("id");
        var value = $(this).val();
        var _token = $('input[name="_token"]').val();
        var selectt = document.getElementById('jabatanchild');

        $.ajax({
          url:"{{ route('datajabatan') }}",
          type:"POST",
          data:{select:select, value:value,_token:"{{ csrf_token() }}"},
          success:function(response){

            $('#jabatanchild').html('<option value="" selected disabled>Pilih Jabatan</option>');

            $.each(response.jabatan,function(index,val){
              $('#jabatanchild').append('<option value="' +val.id+  '" @if(old("jabatan")=="' +val.id+ '") selected @endif >' +val.nama_jabatan+ '</option>')
            });
            $('#jabatanchild').selectpicker('refresh');
          }

        })

      }
    });
      $('.edit-nama').selectpicker();
      $('#jabatan').selectpicker();
    $(document).on('click', '.btnDelete', function() {
            var id = $(this).data('id')
            var nama_dinas = $(this).data('nama_dinas')
            var APP_URL = {!! json_encode(url('/analisis_jabatan')) !!}
            document.getElementById("deleteForm").action = APP_URL+'/'+id;
            // document.getElementById("deleteForm").action = '/dinas/'+id;
            $('.deleteID').val(id);
            $('#valuedinas').text(nama_dinas);
          })
    $(document).on('click', '.btnEdit', function() {
      var id = $(this).data('id')
      var level = $(this).data('level')
      var indikator = $(this).data('indikator')
      var deskripsi = $(this).data('deskripsi')
      var nama_kompetensi = $(this).data('nama_kompetensi')
      // document.getElementsByName("nama_kompetensi").val = nama_kompetensi;
      // document.getElementById("editForm").action = '/dinas/'+id;
      var APP_URL = {!! json_encode(url('/manajerial')) !!}
      document.getElementById("editForm").action = APP_URL+'/'+id;
      $('.edit-nama').selectpicker('val', nama_kompetensi);
      // // $('.edit-nama').val(nama_kompetensi);
      // $('.edit-nama').selectpicker('render');
      $('.edit-id').val(id);
      $('.edit-level').val(level);
      $('.edit-indikator').val(indikator);
      $('.edit-deskripsi').val(deskripsi);


    });
    $(document).on('click', '.btnTambah', function() {
      var id_opd = $(this).data('id_opd')
      var nama_dinas = $(this).data('nama_dinas')
      var tingkat = $(this).data('tingkat')
      $('#dinas_id').val(id_opd);
      $('#tingkat').val(tingkat);
      $('#jenis_jabatan').val('');
      $('#jenis_jabatan').selectpicker('refresh');
      $('#jabatan').val('');
      $('#jabatan').selectpicker('refresh');
      // var tingkat = 4;
      if ((tingkat == 0)||(tingkat == 1)){
        let struktural = document.getElementById("struktural").hidden = false;
        document.getElementById("fungsional").hidden = false;
        document.getElementById("pelaksana").hidden = false;
        $('#jenis_jabatan').selectpicker('refresh');
      }else if (tingkat >= 4){
        document.getElementById("struktural").hidden = true;
        document.getElementById("fungsional").hidden = false;
        document.getElementById("pelaksana").hidden = false;
        $('#jenis_jabatan').selectpicker('refresh');
      }else{
        document.getElementById("struktural").hidden = false;
        document.getElementById("fungsional").hidden = false;
        document.getElementById("pelaksana").hidden = false;
        $('#jenis_jabatan').selectpicker('refresh');
      }
      // document.getElementsByName("nama_kompetensi").val = nama_kompetensi;
      // document.getElementById("editForm").action = '/dinas/'+id;
      var APP_URL = {!! json_encode(url('/analisis_jabatan')) !!}
      document.getElementById("tambahForm").action = APP_URL;
      $('#valuedinastambah').text(nama_dinas);
      // $('.edit-nama').selectpicker('val', nama_kompetensi);

      var iddinas = id_opd.toString().padStart(2, 0);

      $.ajax({
          url:"{{ route('getcodeparent') }}",
          type:"POST",
          data:{id_opd:id_opd, iddinas:iddinas, tingkat:tingkat,_token:"{{ csrf_token() }}"},
          success:function(response){
            // console.log(response);
            // var hasil = response;
            $('#kode_jabatan').val(response);
            // document.getElementById("kode_jabatan").value = response;
            // response++;
            // var jumlah = response.toString().padStart(2, 0);
            // $('#kode_jabatan').val(iddinas+' - '+jumlah);
          }

        })

    });
    $(document).on('click', '.tambahChildModal', function() {

      var kode_jabatan = $(this).data('kode_jabatan')
      var id_opd = $(this).data('id_opd')
      var nama_dinas = $(this).data('nama_dinas')
      var tingkat = $(this).data('tingkat')
      $('#dinas_idchild').val(id_opd);
      $('#tingkatchild').val(tingkat);
      $('#kode_jabatanparent').val(kode_jabatan);
      $('#jenis_jabatanchild').val('');
      $('#jenis_jabatanchild').selectpicker('refresh');
      $('#jabatanchild').val('');
      $('#jabatanchild').selectpicker('refresh');
      // var tingkat = 4;
      if ((tingkat == 0)||(tingkat == 1)){
        let struktural = document.getElementById("strukturalchild").hidden = false;
        document.getElementById("fungsionalchild").hidden = true;
        document.getElementById("pelaksanachild").hidden = true;
        $('#jenis_jabatanchild').selectpicker('refresh');
      }else if (tingkat >= 4){
        document.getElementById("strukturalchild").hidden = true;
        document.getElementById("fungsionalchild").hidden = false;
        document.getElementById("pelaksanachild").hidden = false;
        $('#jenis_jabatanchild').selectpicker('refresh');
      }else{
        document.getElementById("strukturalchild").hidden = false;
        document.getElementById("fungsionalchild").hidden = false;
        document.getElementById("pelaksanachild").hidden = false;
        $('#jenis_jabatanchild').selectpicker('refresh');
      }
      // document.getElementsByName("nama_kompetensi").val = nama_kompetensi;
      // document.getElementById("editForm").action = '/dinas/'+id;
      var APP_URL = {!! json_encode(url('/analisis_jabatan_child')) !!}
      document.getElementById("tambahFormchild").action = APP_URL;
      $('#valuedinastambahchild').text(nama_dinas);
      // $('.edit-nama').selectpicker('val', nama_kompetensi);

      // var iddinas = id_opd.toString().padStart(2, 0);
      $.ajax({
          url:"{{ route('getcodechild') }}",
          type:"POST",
          data:{id_opd:id_opd, kode_jabatan:kode_jabatan, tingkat:tingkat,_token:"{{ csrf_token() }}"},
          success:function(response){
            // console.log(response);
            $('#kode_jabatanchild').val(response);
            // response;
            // var jumlah = response.toString().padStart(2, 0);
            // $('#kode_jabatan').val(iddinas+' - '+jumlah);
          }

        })

    });
    // $(document).on('click', '.btn-simpan', function() {
    //   $('.edit-nama').selectpicker().attr('disabled', false);
    // });

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
