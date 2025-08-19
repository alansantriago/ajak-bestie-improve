@extends('layouts.app', ['title' => __('Penambahan Biodata Jabatan Jabatan | ' . $kode_jabatan)])

@section('content')
    @include('admin.header', ['halaman' => __('Penambahan Biodata Jabatan | ' . $kode_jabatan)])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-12 order-xl-1 mb-3">

                <div class="card shadow mb-3">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="mx-auto mt-4">
                                <h3 class="text-center">
                                    {{ __('Penambahan Biodata Pegawai Jabatan ' . $jabatan->datajabatan->nama_jabatan) }}
                                </h3>
                            </div>
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
                        @if (session('message'))
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form role="form" action ="{{ route('biodata_jabatan.store', $kode_jabatan) }}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="container-fluid mt--1">
                                <div class="row justify-content-center">
                                    <div class="col-xl-9 order-xl-1 mb-2">
                                        <div class="card shadow mb-2">
                                            <div class="card-header bg-black border-0">
                                                <h3>Penambahan Biodata</h3>
                                                <div class="mx-auto mt-2">

                                                    <div class="form-group row ">
                                                        <label for="nip"
                                                            class="col-md-3 col-form-label">{{ __('Nomor Induk Pegawai') }}</label>
                                                        <div class="col-md-9">
                                                            <input type="number" name="nip" id="nip"
                                                                class="form-control form-control-{{ $errors->has('nip') ? ' is-invalid' : '' }}"
                                                                placeholder="{{ __('Masukkan Nomor Induk Pegawaii') }}"
                                                                value="{{ old('nip') }}" min = "0" required
                                                                autofocus>

                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="nama"
                                                            class="col-md-3 col-form-label">{{ __('Nama Pegawai') }}</label>
                                                        <div class="col-md-9 ">
                                                            <input type="text" name="nama" id="nama"
                                                                class="form-control form-control-{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                                                placeholder="{{ __('Masukkan Nama Pegawai') }}"
                                                                value="{{ old('nama') }}" min = "0" required
                                                                autofocus>

                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat
                                                            Lahir</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                                class="form-control form-control-{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}"
                                                                placeholder="{{ __('Tempat Lahir') }}"
                                                                value="{{ old('tempat_lahir') }}" min = "0" required
                                                                autofocus>

                                                        </div>

                                                        <label for="tanggal_lahir"
                                                            class="col-sm-2 col-form-label text-center">Tanggal
                                                            Lahir</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                                class="form-control form-control-{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}"
                                                                placeholder="{{ __('Bulan') }}"
                                                                value="{{ old('tanggal_lahir') }}" min = "0" required
                                                                autofocus>

                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="masa_kerja_jabatan_tahun"
                                                            class="col-sm-3 col-form-label">Masa Kerja
                                                            Jabatan</label>
                                                        <div class="col-sm-2">
                                                            <select name="masa_kerja_jabatan_tahun"
                                                                id="masa_kerja_jabatan_tahun"
                                                                class="form-control selectpicker" required>
                                                                <option value="">-Pilih-</option>
                                                                @for ($tahun = 0; $tahun <= 100; $tahun++)
                                                                    <option value="{{ $tahun }}"
                                                                        {{ old('masa_kerja_jabatan_tahun') == $tahun ? 'selected' : '' }}>
                                                                        {{ $tahun }}
                                                                    </option>
                                                                @endfor
                                                            </select>

                                                        </div>
                                                        <label for="masa_kerja_jabatan_bulan"
                                                            class="col-sm-2 col-form-label">Tahun</label>
                                                        <div class="col-sm-2">
                                                            <select name="masa_kerja_jabatan_bulan"
                                                                id="masa_kerja_jabatan_bulan"
                                                                class="form-control selectpicker" required>
                                                                <option value="">-Pilih-</option>
                                                                @for ($bulan = 0; $bulan <= 12; $bulan++)
                                                                    <option value="{{ $bulan }}"
                                                                        {{ old('masa_kerja_jabatan_bulan') == $bulan ? 'selected' : '' }}>
                                                                        {{ $bulan }}
                                                                    </option>
                                                                @endfor
                                                            </select>

                                                        </div>
                                                        <label for="masa_kerja_jabatan_bulan"
                                                            class="col-sm-2 col-form-label">Bulan</label>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="masa_kerja_keseluruhan_tahun"
                                                            class="col-sm-3 col-form-label">Masa Kerja
                                                            Keseluruhan</label>
                                                        <div class="col-sm-2">
                                                            <select name="masa_kerja_keseluruhan_tahun"
                                                                id="masa_kerja_keseluruhan_tahun"
                                                                class="form-control selectpicker" required>
                                                                <option value="">-Pilih-</option>
                                                                @for ($tahun = 0; $tahun <= 100; $tahun++)
                                                                    <option value="{{ $tahun }}"
                                                                        {{ old('masa_kerja_keseluruhan_tahun') == $tahun ? 'selected' : '' }}>
                                                                        {{ $tahun }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            @if ($errors->has('masa_kerja_keseluruhan_tahun'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('masa_kerja_keseluruhan_tahun') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <label for="masa_kerja_keseluruhan_bulan"
                                                            class="col-sm-2 col-form-label">Tahun</label>
                                                        <div class="col-sm-2">
                                                            <select name="masa_kerja_keseluruhan_bulan"
                                                                id="masa_kerja_keseluruhan_bulan"
                                                                class="form-control selectpicker" required>
                                                                <option value="">-Pilih-</option>
                                                                @for ($bulan = 0; $bulan <= 12; $bulan++)
                                                                    <option value="{{ $bulan }}"
                                                                        {{ old('masa_kerja_keseluruhan_bulan') == $bulan ? 'selected' : '' }}>
                                                                        {{ $bulan }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            @if ($errors->has('masa_kerja_keseluruhan_bulan'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('masa_kerja_keseluruhan_bulan') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <label for="masa_kerja_keseluruhan_bulan"
                                                            class="col-sm-2 col-form-label">Bulan</label>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="riwayat"
                                                            class="col-sm-3 col-form-label">Riwayat</label>
                                                        <div class="col-sm-9">
                                                            <textarea name="riwayat" id="riwayat"
                                                                class="form-control form-control-{{ $errors->has('riwayat') ? ' is-invalid' : '' }}"
                                                                placeholder="{{ __('Riwayat') }}" rows="3" required autofocus>{{ old('riwayat') }}</textarea>
                                                            @if ($errors->has('riwayat'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('riwayat') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="tahun_diangkat" class="col-sm-3 col-form-label">Tahun
                                                            Diangkat</label>
                                                        <div class="col-sm-3">
                                                            <select name="tahun_diangkat" id="tahun_diangkat"
                                                                class="form-control selectpicker" required>
                                                                <option value="">--Pilih Tahun--</option>
                                                                @for ($tahun = 1955; $tahun <= date('Y') + 100; $tahun++)
                                                                    <option value="{{ $tahun }}"
                                                                        {{ old('tahun_diangkat') == $tahun ? 'selected' : '' }}>
                                                                        {{ $tahun }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            @if ($errors->has('tahun_diangkat'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('tahun_diangkat') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <label for="tahun_pensiun"
                                                            class="col-sm-3 col-form-label text-center">Tahun
                                                            Pensiun</label>
                                                        <div class="col-sm-3">
                                                            <select name="tahun_pensiun" id="tahun_pensiun"
                                                                class="form-control selectpicker" required>
                                                                <option value="">--Pilih Tahun--</option>
                                                                @for ($tahun = 2023; $tahun <= date('Y') + 100; $tahun++)
                                                                    <option value="{{ $tahun }}"
                                                                        {{ old('tahun_pensiun') == $tahun ? 'selected' : '' }}>
                                                                        {{ $tahun }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            @if ($errors->has('tahun_pensiun'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('tahun_pensiun') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @php
                                                        $pangkatPNS = [
                                                            'Juru Muda / (I.a)',
                                                            'Juru Muda Tk. I / (I.b)',
                                                            'Juru / (I.c)',
                                                            'Juru Tk. I / (I.d)',
                                                            'Pengatur Muda / (II.a)',
                                                            'Pengatur Muda Tk I / (II.b)',
                                                            'Pengatur / (II.c)',
                                                            'Pengatur Tk I / (II.d)',
                                                            'Penata Muda / (III.a)',
                                                            'Penata Muda Tk. I / (III.b)',
                                                            'Penata / (III.c)',
                                                            'Penata Tk. I / (III.d)',
                                                            'Pembina / (IV.a)',
                                                            'Pembina Tk. I / (IV.b)',
                                                            'Pembina Utama Muda / (IV.c)',
                                                            'Pembina Utama Madya / (IV.d)',
                                                        ];

                                                        $pangkatPPPK = [
                                                            'I',
                                                            'II',
                                                            'III',
                                                            'IV',
                                                            'V',
                                                            'VI',
                                                            'VII',
                                                            'VIII',
                                                            'IX',
                                                            'X',
                                                            'XI',
                                                            'XII',
                                                            'XIII',
                                                            'XIV',
                                                            'XV',
                                                            'XVI',
                                                            'XVII',
                                                        ];

                                                    @endphp
                                                    <div class="form-group row">
                                                        <label for="pangkat"
                                                            class="col-sm-3 col-form-label">Pangkat / Golongan</label>
                                                        <div class="col-sm-9 {{ $errors->has('pangkat') ? ' has-danger' : '' }}">
                                                            <select name="pangkat" id="pangkat"
                                                                class="form-control selectpicker form-control-{{ $errors->has('pangkat') ? 'is-invalid' : '' }}" required>
                                                                <option value="" selected disabled>-- Pilih Pangkat / Golongan --</option>

                                                                {{-- Pangkat PNS --}}
                                                                @foreach ($pangkatPNS as $pangkat)
                                                                    <option value="{{ $pangkat }}"
                                                                      {{ old('pangkat') == $pangkat ? 'selected' : '' }}>
                                                                        {{ $pangkat }}
                                                                    </option>
                                                                @endforeach
                                                                <option value="" disabled>-- Golongan PPPK--</option>
                                                                {{-- Pangkat PPPK --}}
                                                                @foreach ($pangkatPPPK as $pangkat)
                                                                    <option value="{{ $pangkat }}"
                                                                      {{ old('pangkat') == $pangkat ? 'selected' : '' }}>
                                                                        Golongan {{ $pangkat }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="jenjang_pendidikan"
                                                            class="col-sm-3 col-form-label">Jenjang
                                                            Pendidikan</label>
                                                        <div class="col-sm-9">
                                                            <select name="jenjang_pendidikan" id="jenjang_pendidikan"
                                                                class="form-control selectpicker form-control-{{ $errors->has('jenjang_pendidikan') ? ' is-invalid' : '' }}"
                                                                required autofocus>
                                                                <option value="">-- Pilih Jenjang Pendidikan
                                                                    --</option>
                                                                @php
                                                                    $jenjang_pendidikan = jenjang_pendidikan();
                                                                @endphp
                                                                @foreach ($jenjang_pendidikan as $index)
                                                                    <option value="{{ $index->value }}"
                                                                        {{ old('jenjang_pendidikan') == $index->value ? 'selected' : '' }}>
                                                                        {{ $index->value }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="jurusan"
                                                            class="col-md-3 col-form-label">{{ __('Jurusan') }}</label>
                                                        <div class="col-md-9 ">
                                                            <input type="text" name="jurusan" id="jurusan"
                                                                class="form-control form-control-{{ $errors->has('jurusan') ? ' is-invalid' : '' }}"
                                                                placeholder="{{ __('Jurusan') }}"
                                                                value="{{ old('jurusan') }}" min = "0" required
                                                                autofocus>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class=" justify-content-center text-center mt-3">
                                <a href="{{ route('biodata_jabatan.edit', $jabatan->kode_jabatan) }}"
                                    class="btn btn-info">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')

    @endsection

    @push('js')
        <script src="{{ asset('argon') }}/js/bootstrap.bundle.js"></script>
    @endpush
