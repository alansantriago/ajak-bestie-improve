@extends('layouts.app', ['title' => __('Beban Kerja | ' . $kode_jabatan)])

@section('content')
    @include('admin.header', ['halaman' => __('Beban Kerja | ' . $kode_jabatan)])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-12 order-xl-1 mb-3">
                {{-- Tugas Pokok Jabatan --}}
                <div class="card shadow mb-3">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="mx-auto mt-4">
                                <h3 class="text-center">{{ __('Beban Kerja ' . $jabatan->datajabatan->nama_jabatan) }}</h3>

                                <h4 class="text-center text-warning"><b>{{ __($jabatan->datajabatan->jenis_jabatan) }}</b>
                                </h4>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3 mx-auto">

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
                                    <ong>{{ $error }}</ong><br>
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
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-bordered" id="customerList"
                                style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        {{-- <th scope="col">No</th> --}}
                                        <th scope="col-1" class="text-center">NO</th>
                                        <th scope="col-2" class=" text-center">Uraian Tugas</th>
                                        <th scope="col" class="text-center">Hasil Kerja</th>
                                        <th scope="col" class="text-center">Jumlah Hasil</th>
                                        <th scope="col" class="text-center">Penyelesaian (JAM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // dd($beban_kerja[0]['jumlah_hasil']);
                                        $i = 0;
                                    @endphp
                                    <form role="form" action="/analisis_beban_kerja/{{ $jabatan->kode_jabatan }}"
                                        enctype="multipart/form-data" method="POST">
                                        @method('PUT')
                                        @csrf

                                        @if ($beban_kerja->first() == null)
                                            @foreach ($jabatan->data_tugas_pokok as $index)
                                                <tr>
                                                    <th class="col-1 text-center">
                                                        <?php echo $i + 1;
                                                        ?>
                                                    </th>
                                                    <th class="col-2">
                                                        <textarea cols="10" rows="2" class="form-control form-control" disabled>{{ $index->uraian_tugas }}</textarea>
                                                    </th>
                                                    <th class="col-2 text-center">
                                                        {{ $index->hasil_kerja }}
                                                    </th>

                                                    <th class="col-1 text-center">
                                                        <input type="number" name="jumlah[]" id="jumlah{{ $i + 1 }}"
                                                            class="form-control form-control-{{ $errors->has('jumlah' . ($i + 1)) ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Jumlah Hasil') }}"
                                                            value="{{ old('jumlah.' . ($i + 1)) }}" min="0" required
                                                            autofocus onchange="getpegawai()">
                                                    </th>
                                                    <th class="col-1 text-center">
                                                        <input type="number" name="penyelesaian[]" step="0.01"
                                                            id="penyelesaian{{ $i + 1 }}"
                                                            class="form-control form-control-{{ $errors->has('penyelesaian' . ($i + 1)) ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Penyelesaian (JAM)') }}"
                                                            value="{{ old('penyelesaian.' . ($i + 1)) }}" min="0"
                                                            required autofocus onchange="getpegawai()">
                                                    </th>
                                                </tr>

                                                <?php $i++; ?>
                                            @endforeach
                                        @else
                                            @foreach ($beban_kerja as $index)
                                                <tr>
                                                    <th class="col-1 text-center">
                                                        <?php echo $i + 1;
                                                        // dd($jabatan);
                                                        ?>
                                                    </th>
                                                    <th class="col-3 text-center">
                                                        <textarea cols="10" rows="2" class="form-control form-control" disabled>{{ $jabatan->data_tugas_pokok[$i]['uraian_tugas'] }}</textarea>
                                                    </th>
                                                    <th class="col-2 text-center">
                                                        {{ $jabatan->data_tugas_pokok[$i]['hasil_kerja'] }}
                                                    </th>

                                                    <th class="col-1 text-center">
                                                        <input type="number" name="jumlah[]"
                                                            id="jumlah{{ $i + 1 }}"
                                                            class="form-control text-center  form-control-{{ $errors->has('jumlah' . ($i + 1)) ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Jumlah Hasil') }}"
                                                            value="{{ old('jumlah.' . ($i + 1), $index->jumlah_hasil) }}"
                                                            required autofocus min="0" onchange="getpegawai()">
                                                    </th>
                                                    <th class="col-1 text-center">
                                                        <input type="number" name="penyelesaian[]" step="0.01"
                                                            id="penyelesaian{{ $i + 1 }}"
                                                            class="form-control text-center form-control-{{ $errors->has('penyelesaian' . ($i + 1)) ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Penyelesaian (JAM)') }}"
                                                            value="{{ old('penyelesaian.' . ($i + 1), $index->penyelesaian) }}"
                                                            required autofocus min="0" onchange="getpegawai()">
                                                    </th>
                                                </tr>

                                                <?php $i++; ?>
                                            @endforeach
                                            @while ($i != $jabatan->data_tugas_pokok->count())
                                                <tr>
                                                    <th class="col-1 text-center">
                                                        <?php echo $i + 1;
                                                        ?>
                                                    </th>
                                                    <th class="col-3 text-center">
                                                        <textarea cols="10" rows="2" class="form-control form-control" readonly>{{ $jabatan->data_tugas_pokok[$i]['uraian_tugas'] }}</textarea>
                                                    </th>
                                                    <th class="col-2 text-center">
                                                        {{ $jabatan->data_tugas_pokok[$i]['hasil_kerja'] }}
                                                    </th>

                                                    <th class="col-1 text-center">
                                                        <input type="number" name="jumlah[]"
                                                            id="jumlah{{ $i + 1 }}"
                                                            class="form-control text-center form-control-{{ $errors->has('jumlah' . ($i + 1)) ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Jumlah Hasil') }}"
                                                            value="{{ old('jumlah.' . ($i + 1)) }}" required autofocus
                                                            min="0" onchange="getpegawai()">
                                                    </th>
                                                    <th class="col-1 text-center">
                                                        <input type="number" name="penyelesaian[]" step="0.01"
                                                            id="penyelesaian{{ $i + 1 }}"
                                                            class="form-control text-center form-control-{{ $errors->has('penyelesaian' . ($i + 1)) ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Penyelesaian (JAM)') }}"
                                                            value="{{ old('penyelesaian.' . ($i + 1)) }}" required
                                                            autofocus min="0" onchange="getpegawai()">
                                                    </th>
                                                </tr>
                                                <?php $i++; ?>
                                            @endwhile
                                        @endif
                                        @if ($jabatan->data_tugas_pokok->first() != null)
                                            <tr>
                                                <th class="col-1 text-center">

                                                </th>
                                                <th class="col-12 col-md-3 text-center" id="opsiFungsional">
                                                    <button class="btn btn-secondary" type="button" id="TampilInputFile"
                                                        data-toggle="collapse" data-target="#collapseInputOptions"
                                                        aria-expanded="true" aria-controls="collapseInputOptions">
                                                        Berdasarkan Input Nilai
                                                    </button>
                                                    {{-- @endif --}}
                                                    <!-- Collapsible Section -->
                                                    <div class="collapse mt-3" id="collapseInputOptions">
                                                        <!-- Input file PDF -->
                                                        <div id="fileInputSection">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span
                                                                        class="input-group-text bg-primary text-white">Input
                                                                        File PDF</span>
                                                                </div>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="file_input" name="file_input" accept=".pdf"
                                                                        required>
                                                                    <label class="custom-file-label"
                                                                        for="file_input">Pilih file PDF</label>
                                                                </div>
                                                            </div>

                                                            <!-- Button to trigger modal to show file -->
                                                            <button type="button" class="btn btn-info mt-3"
                                                                id="showFileBtn" data-toggle="modal"
                                                                data-target="#pdfModal" disabled>Show File</button>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="col-1 text-center">
                                                    <div class="input-group mb-3">
                                                        <span
                                                            class="input-group-text bg-primary text-white ">Bezetting</span>

                                                        <input type="number" name="pegawaiku" id="pegawaiku"
                                                            class="form-control text-center  text-lg"
                                                            value="{{ old('pegawaiku', $jabatan->pegawai) }}"
                                                            placeholder="{{ __('Bezetting') }}" onchange="getpegawai()"
                                                            required>
                                                    </div>
                                                    <div class="input-group ">
                                                        <span
                                                            class="input-group-text bg-warning text-dark ">Keterangan</span>

                                                        <input type="number" name="keterangan" id="keterangan"
                                                            class="form-control text-center  text-lg"
                                                            placeholder="{{ __('Keterangan') }}" value="" disabled>
                                                    </div>
                                                </th>

                                                <th colspan="2" class="col-1 text-center">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-info text-dark ">Total</span>
                                                        @php
                                                            if ($jabatan->total_beban_kerja != null) {
                                                                $total_beban_kerja = $jabatan->total_beban_kerja;
                                                            } else {
                                                                $total_beban_kerja = 0;
                                                            }
                                                        @endphp
                                                        <input type="number" name="total" id="total"
                                                            class="form-control text-center text-lg"
                                                            placeholder="{{ __('Kebutuhan Pegawai') }}"
                                                            value="{{ old('total', $total_beban_kerja) }}" step="0.0001"
                                                            min="0" onchange="getpegawai()">
                                                    </div>
                                                    <div class="input-group ">
                                                        <span class="input-group-text bg-info text-dark ">Pegawai</span>

                                                        <input type="number" name="pegawai" id="pegawai"
                                                            class="form-control text-center kebutuhan text-lg"
                                                            placeholder="{{ __('Kebutuhan Pegawai') }}" value=""
                                                            disabled>
                                                    </div>
                                                </th>

                                            </tr>
                                        @endif
                                </tbody>
                            </table>
                            @if ($jabatan->data_tugas_pokok->first() == null)
                                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                    Tidak Ada Data Tugas Pokok. Silahkan Hubungin admin untuk menambah data
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if ($jabatan->detaildinas->status == 'kunci')
                                <!-- Alert -->
                                <div class="alert alert-danger alert-dismissible fade show text-center my-3"
                                    role="alert">
                                    Perubahan untuk {{ $jabatan->detaildinas->nama_dinas }} dikunci. Hubungi admin untuk
                                    membukanya !!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @else
                                <div class=" justify-content-center text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            @endif

                            </form>

                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">File PDF</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="pdfViewer" src="" width="100%" height="500px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    @endsection

    @push('js')
        <script>
            var isFungsional = '{{ $jabatan->datajabatan->jenis_jabatan }}' == 'Fungsional';
            var fileInput = document.getElementById('file_input');

            function getpegawai() {

                if (collapseElement.hasClass('show')) {
                    var totalfix = document.getElementById("total").value;
                    var pegawai = Math.round(totalfix);
                } else {
                    var jumlah = document.getElementsByName('jumlah[]');
                    var penyelesaian = document.getElementsByName('penyelesaian[]');
                    var total = 0;
                    for (var i = 0; i < jumlah.length; i++) {
                        var a = jumlah[i].value;
                        var b = penyelesaian[i].value;
                        total += (a / 1250) * b;
                    }
                    // document.getElementsByName("kebutuhan").value = total;
                    var totalfix = total.toFixed(3);
                    var pegawai = Math.round(total);
                    document.getElementById("total").value = totalfix;
                }

                document.getElementById("pegawai").value = pegawai;
                var pegawaiku = document.getElementById('pegawaiku');
                var keterangan = pegawaiku.value - pegawai;
                document.getElementById("keterangan").value = keterangan;
            };

            var collapseElement = $('#collapseInputOptions');
            var jumlahInputs = document.getElementsByName('jumlah[]');
            var penyelesaianInputs = document.getElementsByName('penyelesaian[]');
            var totalInput = document.getElementsByName('total')[0];
            var pegawaiInput = document.getElementsByName('pegawai')[0];

            // Menyimpan nilai data sebelumnya
            var savedJumlahValues = [];
            var savedPenyelesaianValues = [];
            var savedTotalValue = '';
            var savedPegawaiValue = '';
            // Event listener for collapse show (jika terbuka)
            collapseElement.on('show.bs.collapse', function() {
                disableInputs();
                var totalfix = document.getElementById("total").value;
                var pegawai = Math.round(totalfix);

                document.getElementById("pegawai").value = pegawai;
                var pegawaiku = document.getElementById('pegawaiku');
                var keterangan = pegawaiku.value - pegawai;
                document.getElementById("keterangan").value = keterangan;
                // getpegawai();
            });

            // Event listener for collapse hide (jika tertutup)
            collapseElement.on('hide.bs.collapse', function() {
                restoreInputs();
                // getpegawai();
            });

            // Fungsi untuk men-disable input dan menyimpan nilainya
            function disableInputs() {
                // Simpan nilai input sebelum diset null
                savedJumlahValues = [];
                savedPenyelesaianValues = [];

                // Loop untuk setiap input jumlah[] dan simpan nilai
                for (var i = 0; i < jumlahInputs.length; i++) {
                    savedJumlahValues[i] = jumlahInputs[i].value; // Simpan nilai
                    jumlahInputs[i].removeAttribute('required');
                    jumlahInputs[i].removeAttribute('autofocus');
                    jumlahInputs[i].setAttribute('disabled', 'disabled');
                    jumlahInputs[i].value = null; // Setel value menjadi null
                }

                // Loop untuk setiap input penyelesaian[] dan simpan nilai
                for (var i = 0; i < penyelesaianInputs.length; i++) {
                    savedPenyelesaianValues[i] = penyelesaianInputs[i].value; // Simpan nilai
                    penyelesaianInputs[i].removeAttribute('required');
                    penyelesaianInputs[i].removeAttribute('autofocus');
                    penyelesaianInputs[i].setAttribute('disabled', 'disabled');
                    penyelesaianInputs[i].value = null; // Setel value menjadi null
                }

                // Simpan nilai total dan pegawai sebelum diset null
                savedTotalValue = totalInput.value;
                savedPegawaiValue = pegawaiInput.value;
                TampilInputFile.innerText = "Ganti Berdasarkan Input ABK";
                fileInput.setAttribute('required', 'required');
            }

            // Fungsi untuk mengembalikan input sebelumnya jika collapse hide
            function restoreInputs() {
                // Kembalikan nilai jumlah[] yang disimpan
                for (var i = 0; i < jumlahInputs.length; i++) {
                    jumlahInputs[i].removeAttribute('disabled');
                    jumlahInputs[i].setAttribute('required', 'required');
                    jumlahInputs[i].value = savedJumlahValues[i] || ''; // Kembalikan nilai sebelumnya
                }

                // Kembalikan nilai penyelesaian[] yang disimpan
                for (var i = 0; i < penyelesaianInputs.length; i++) {
                    penyelesaianInputs[i].removeAttribute('disabled');
                    penyelesaianInputs[i].setAttribute('required', 'required');
                    penyelesaianInputs[i].value = savedPenyelesaianValues[i] || ''; // Kembalikan nilai sebelumnya
                }

                // Kembalikan nilai total dan pegawai yang disimpan
                if (totalInput) {
                    totalInput.removeAttribute('disabled');
                    totalInput.value = savedTotalValue || '';
                    totalInput.setAttribute('required', 'required'); // Kembalikan nilai sebelumnya
                }

                TampilInputFile.innerText = "Ganti Berdasarkan Input File";
                fileInput.removeAttribute('required');
            }

            function cekFungsional() {

                if (!isFungsional) {
                    opsiFungsional.style.display = 'none'; // Menyembunyikan elemen
                    // disableInputs();
                    // restoreInputs();

                fileInput.removeAttribute('required');
                     getpegawai();
                }
            }

            function cekStatusOpd() {
                @if ($jabatan->detaildinas->status == 'kunci')
                    TampilInputFile.style.display = 'none';
                    // Mendapatkan semua elemen input di halaman
                    var allInputs = document.querySelectorAll('input');

                    // Loop melalui setiap elemen input dan tambahkan atribut disabled
                    allInputs.forEach(function(input) {
                        input.disabled = true;
                    });
                @endif
            }
            $(document).ready(function() {
                cekFungsional();
                cekStatusOpd();
                var TampilInputFile = document.getElementById('TampilInputFile');
                var collapseElement = $('#collapseInputOptions');
                var pdfViewer = document.getElementById('pdfViewer');
                var showFileBtn = document.getElementById('showFileBtn');
                var opsiFungsional = document.getElementById('opsiFungsional');
                var existingFile = null; // Menggunakan "null" dengan huruf kecil

                showFileBtn.innerText = "Belum Ada File";
                // File dari database (jika ada)
                @if ($jabatan->file_beban_kerja != null)
                    existingFile =
                        "{{ asset('storage/beban_kerja_pdf/' . $jabatan->file_beban_kerja) }}";
                @endif
                var newFileSelected = false;
                var objectURL = null;

                // Mengaktifkan tombol Show File jika ada file dari database
                if (existingFile && existingFile !== '') {
                    showFileBtn.disabled = false;
                    showFileBtn.innerText = "Tampilkan File";
                    fileInput.removeAttribute('required');
                    collapseElement.collapse('show'); // Buka collapse
                    TampilInputFile.innerText = "Ganti Berdasarkan Input Nilai";
                } else {
                    collapseElement.collapse('hide'); // Tutup collapse jika tidak ada file
                    TampilInputFile.innerText = "Ganti Berdasarkan Input ABK";

                fileInput.removeAttribute('required');
                    getpegawai();
                }

                // Event untuk file input
                fileInput.addEventListener('change', function(event) {
                    var file = event.target.files[0];

                    // Pastikan file yang dipilih berjenis PDF
                    if (file && file.type === 'application/pdf') {
                        var fileName = file.name;
                        var label = document.querySelector('label[for="file_input"]');
                        label.textContent = fileName;

                        // Buat URL baru untuk file baru yang dipilih
                        objectURL = URL.createObjectURL(file);
                        console.log('Object URL created:', objectURL); // Debug URL

                        newFileSelected = true;

                        // Aktifkan tombol Show File
                        showFileBtn.disabled = false;
                        showFileBtn.innerText = "Tampilkan File";
                    } else {
                        alert('Please select a valid PDF file.');
                        showFileBtn.disabled = true;
                        showFileBtn.innerText = "Belum Ada File";
                    }
                });

                // Saat modal ditampilkan
                $('#pdfModal').on('shown.bs.modal', function() {
                    if (newFileSelected && objectURL) {
                        // Jika ada file baru yang dipilih, tampilkan file baru
                        pdfViewer.src = objectURL;
                        console.log('Displaying new file:', objectURL); // Debug file display
                    } else if (existingFile) {
                        // Jika tidak ada file baru, tampilkan file dari database
                        pdfViewer.src = existingFile;
                        console.log('Displaying file from database:', existingFile); // Debug database file
                    } else {
                        // Jika tidak ada file di database maupun file baru yang dipilih
                        pdfViewer.src = "";
                        console.log('No file available to display.');
                    }
                });

            })
        </script>
        {{-- <script src="{{ asset('argon') }}/js/bootap.bundle.js"></script> --}}
    @endpush
