<div class="card shadow mb-2 md-col-5 mx-2">
    <div class="card-header bg-black border-0">
        <h3>Biodata ke-{{ $index + 1 }}</h3>
    </div>
    <div class="mt-2 px-4">
        <div class="form-group row">
            <label for="nip{{ $index }}" class="col-md-3 col-form-label">Nomor Induk Pegawai</label>
            <div class="col-md-9">
                <input type="number" name="nip[]" id="nip{{ $index }}"
                    class="form-control form-control-{{ $errors->has('nip') ? 'is-invalid' : '' }}"
                    placeholder="Masukkan Nomor Induk Pegawai" value="{{ old('nip.' . $index, $data['nip'] ?? '') }}"
                    min="0" {{ $required ? 'required' : '' }} autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama{{ $index }}" class="col-md-3 col-form-label">Nama Pegawai</label>
            <div class="col-md-9">
                <input type="text" name="nama[]" id="nama{{ $index }}"
                    class="form-control form-control-{{ $errors->has('nama') ? 'is-invalid' : '' }}"
                    placeholder="Masukkan Nama Pegawai" value="{{ old('nama.' . $index, $data['nama'] ?? '') }}"
                    {{ $required ? 'required' : '' }} autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="tempat_lahir{{ $index }}" class="col-md-3 col-form-label">Tempat Lahir</label>
            <div class="col-md-3">
                <input type="text" name="tempat_lahir[]" id="tempat_lahir{{ $index }}"
                    class="form-control form-control-{{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}"
                    placeholder="Tempat Lahir" value="{{ old('tempat_lahir.' . $index, $data['tempat_lahir'] ?? '') }}"
                    {{ $required ? 'required' : '' }} autofocus>
            </div>

            <label for="tanggal_lahir{{ $index }}" class="col-md-2 col-form-label text-center">Tanggal
                Lahir</label>
            <div class="col-md-3">
                <input type="date" name="tanggal_lahir[]" id="tanggal_lahir{{ $index }}"
                    class="form-control form-control-{{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}"
                    value="{{ old('tanggal_lahir.' . $index, $data['tanggal_lahir'] ?? '') }}"
                    {{ $required ? 'required' : '' }} autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="masa_kerja_jabatan_tahun{{ $index }}" class="col-md-3 col-form-label">Masa Kerja
                Jabatan</label>
            <div class="col-md-4 mb-2">
                <select name="masa_kerja_jabatan_tahun[]" id="masa_kerja_jabatan_tahun{{ $index }}"
                    class="form-control selectpicker" {{ $required ? 'required' : '' }}>
                    <option value="">-Tahun-</option>
                    @for ($tahun = 0; $tahun <= 100; $tahun++)
                        <option value="{{ $tahun }}"
                            {{ old('masa_kerja_jabatan_tahun.' . $index, $data['masa_kerja_jabatan_tahun'] ?? '') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }} Tahun
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <select name="masa_kerja_jabatan_bulan[]" id="masa_kerja_jabatan_bulan{{ $index }}"
                    class="form-control selectpicker" {{ $required ? 'required' : '' }}>
                    <option value="">-Bulan-</option>
                    @for ($bulan = 0; $bulan <= 12; $bulan++)
                        <option value="{{ $bulan }}"
                            {{ old('masa_kerja_jabatan_bulan.' . $index, $data['masa_kerja_jabatan_bulan'] ?? '') == $bulan ? 'selected' : '' }}>
                            {{ $bulan }} Bulan
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="masa_kerja_keseluruhan_tahun{{ $index }}" class="col-md-3 col-form-label">Masa Kerja
                Keseluruhan</label>
            <div class="col-md-4 mb-2">
                <select name="masa_kerja_keseluruhan_tahun[]" id="masa_kerja_keseluruhan_tahun{{ $index }}"
                    class="form-control selectpicker" {{ $required ? 'required' : '' }}>
                    <option value="">-Tahun-</option>
                    @for ($tahun = 0; $tahun <= 100; $tahun++)
                        <option value="{{ $tahun }}"
                            {{ old('masa_kerja_keseluruhan_tahun.' . $index, $data['masa_kerja_keseluruhan_tahun'] ?? '') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }} Tahun
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <select name="masa_kerja_keseluruhan_bulan[]" id="masa_kerja_keseluruhan_bulan{{ $index }}"
                    class="form-control selectpicker" {{ $required ? 'required' : '' }}>
                    <option value="">-Bulan-</option>
                    @for ($bulan = 0; $bulan <= 12; $bulan++)
                        <option value="{{ $bulan }}"
                            {{ old('masa_kerja_keseluruhan_bulan.' . $index, $data['masa_kerja_keseluruhan_bulan'] ?? '') == $bulan ? 'selected' : '' }}>
                            {{ $bulan }} Bulan
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="riwayat{{ $index }}" class="col-md-3 col-form-label">Riwayat</label>
            <div class="col-md-9 mb-2">
                <textarea name="riwayat[]" id="riwayat{{ $index }}"
                    class="form-control form-control-{{ $errors->has('riwayat') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Riwayat') }}" rows="3" @if ($index == 0) required @endif autofocus>{{ old('riwayat.' . $index, $data['riwayat'] ?? '') }}</textarea>
                @if ($errors->has('riwayat'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('riwayat') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="tahun_diangkat{{ $index }}" class="col-md-3 col-form-label">Tahun Diangkat</label>
            <div class="col-md-3">
                <select name="tahun_diangkat[]" id="tahun_diangkat{{ $index }}"
                    class="form-control selectpicker" @if ($index == 0) required @endif>
                    <option value="">--Pilih Tahun--</option>
                    @for ($tahun = 1955; $tahun <= date('Y') + 100; $tahun++)
                        <option value="{{ $tahun }}"
                            {{ old('tahun_diangkat.' . $index, $data['tahun_diangkat']?? '') == $tahun ? 'selected' : '' }}>
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

            <label for="tahun_pensiun{{ $index }}" class="col-md-2 col-form-label text-center">Tahun
                Pensiun</label>
            <div class="col-md-3">
                <select name="tahun_pensiun[]" id="tahun_pensiun{{ $index}}" class="form-control selectpicker"
                    @if ($index == 0) required @endif>
                    <option value="">--Pilih Tahun--</option>
                    @for ($tahun = 2023; $tahun <= date('Y') + 100; $tahun++)
                        <option value="{{ $tahun }}"
                            {{ old('tahun_pensiun.' . $index,$data['tahun_pensiun']?? '') == $tahun ? 'selected' : '' }}>
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
            <label for="pangkat{{ $index }}" class="col-md-3 col-form-label">Pangkat / Golongan</label>
            <div class="col-md-9">
                <select name="pangkat[]" id="pangkat{{ $index }}"
                    class="form-control selectpicker form-control-{{ $errors->has('pangkat') ? 'is-invalid' : '' }}"
                    {{ $required ? 'required' : '' }}>
                    <option value="">-- Pilih Pangkat --</option>

                    {{-- Pangkat PNS --}}
                    @foreach ($pangkatPNS as $pangkat)
                        <option value="{{ $pangkat }}"
                            {{ old('pangkat.' . $index, $data['pangkat'] ?? '') == $pangkat ? 'selected' : '' }}>
                            {{ $pangkat }}
                        </option>
                    @endforeach
                    <option value="" disabled>-- Golongan PPPK--</option>
                    {{-- Pangkat PPPK --}}
                    @foreach ($pangkatPPPK as $pangkat)
                        <option value="{{ $pangkat }}"
                            {{ old('pangkat.' . $index, $data['pangkat'] ?? '') == $pangkat ? 'selected' : '' }}>
                            Golongan {{ $pangkat }}
                        </option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="form-group row">
            <label for="jenjang_pendidikan{{ $index }}" class="col-md-3 col-form-label">Jenjang
                Pendidikan</label>
            <div class="col-md-9">
                <select name="jenjang_pendidikan[]" id="jenjang_pendidikan{{ $index }}"
                    class="form-control selectpicker form-control-{{ $errors->has('jenjang_pendidikan') ? 'is-invalid' : '' }}"
                    {{ $required ? 'required' : '' }}>
                    <option value="">-- Pilih Jenjang Pendidikan --</option>
                    @foreach (['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'] as $pendidikan)
                        <option value="{{ $pendidikan }}"
                            {{ old('jenjang_pendidikan.' . $index, $data['jenjang_pendidikan'] ?? '') == $pendidikan ? 'selected' : '' }}>
                            {{ $pendidikan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="jurusan{{ $index }}" class="col-md-3 col-form-label">Jurusan</label>
            <div class="col-md-9">
                <input type="text" name="jurusan[]" id="jurusan{{ $index }}"
                    class="form-control form-control-{{ $errors->has('jurusan') ? 'is-invalid' : '' }}"
                    placeholder="Masukkan Jurusan" value="{{ old('jurusan.' . $index, $data['jurusan'] ?? '') }}"
                    {{ $required ? 'required' : '' }} autofocus>
            </div>
        </div>
        @if ($data != NULL)
        <a href="#" class="btn btn-danger btnDelete mb-3" data-id="{{ $data->id }}" data-index="{{ $index + 1 }}"
            data-nip="{{ $data->nip}}" data-nama="{{ $data->nama}}" data-bs-toggle="modal" data-route="{{route('biodata_jabatan.destroy_id', [$data->id])}}"
            data-bs-target="#deleteModal"><i class="fa fa-trash"></i>Hapus Biodata ke-{{ $index + 1 }}</a>
        @endif
    </div>
</div>
