<?php

namespace App\Http\Controllers;

use App\Exports\HubunganJabatanExport;
use App\Exports\RekapBiodataExport;
use App\Models\BiodataJabatanModel;
use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Http\Controllers\LaporanController;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use Illuminate\Support\Facades\File;

// use vendor\phpoffice\phpword;
class LaporanOPDController extends Controller
{
    public function downloadZip($folderPath, $zipFileName)
    {
        // Define full paths
        $folderPath = public_path($folderPath);  // Make sure to pass the folder path without the 'public/' prefix
        $zipFilePath = public_path($zipFileName . '.zip');  // Full path for the zip file

        // Check if the folder exists
        if (!File::exists($folderPath) || !File::isDirectory($folderPath)) {
            return redirect()->back()->withErrors(['folder_path' => 'Folder path does not exist or is not a directory.']);
        }

        $zip = new ZipArchive;

        // Create the ZIP file
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath));
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
        } else {
            return redirect()->back()->withErrors(['zip_creation' => 'Failed to create ZIP file.']);
        }

        // Create a response
        $response = response()->download($zipFilePath)->deleteFileAfterSend(true);;
        // dd($response->getStatusCode());

        if ($response->getStatusCode()) {

            // Dispatch a job to delete files after the response is sent
            dispatch(new \App\Jobs\CleanupFiles($folderPath));
        }
        return $response;
    }

    public function standarkompetensi($dinas_id)
    {
        $LaporanController = new LaporanController();

        $dinas = Dinas::where('id', $dinas_id)->first();
        $jabatans = HubunganJabatan::with('data_kompetensi.data_kompetensi', 'datajabatan', 'kompetensi_teknis', 'standarkompetensi')->where('dinas_id', $dinas_id)
            ->get();
        // dd(auth()->user()->role);

        cekAksesUser($dinas_id);
        // $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/StandarKompetensiJabatan.docx');
        $directoryPath = public_path('kompetensi/' . $dinas_id . ' ' . $dinas->nama_dinas);
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        foreach ($jabatans as $jabatan) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/StandarKompetensiJabatan.docx');
            $namaJabatanFile = str_replace('/', ' atau ', $jabatan->datajabatan->nama_jabatan);
            // Process data_kompetensi
            $dataKompetensi = $jabatan->data_kompetensi ?? collect();
            $values = [];
            for ($i = 0; $i < 8; $i++) {
                $kompetensi = $dataKompetensi->get($i);
                $values[] = [
                    'no' => $i + 1,
                    'nama_kompetensi' => $kompetensi->data_kompetensi->nama_kompetensi ?? '',
                    'level' => $kompetensi->data_kompetensi->level ?? '',
                    'deskripsi' => isset($kompetensi) ? $LaporanController->clean_data($kompetensi->data_kompetensi->deskripsi) : '',
                    'indikator' => isset($kompetensi) ? $LaporanController->processIndikatorTeknis($kompetensi->data_kompetensi->indikator) : '',
                ];
            }

            $templateProcessor->cloneRowAndSetValues('no', $values);

            // Set values for the 9th competency if available
            $kompetensi9 = $dataKompetensi->get(8);
            $templateProcessor->setValues([
                'no#9' => '9',
                'nama_kompetensi#9' => $kompetensi9->data_kompetensi->nama_kompetensi ?? '',
                'level#9' => $kompetensi9->data_kompetensi->level ?? '',
                'deskripsi#9' => isset($kompetensi9) ? $LaporanController->clean_data($kompetensi9->data_kompetensi->deskripsi) : '',
                'indikator#9' => isset($kompetensi9) ? $LaporanController->processIndikatorTeknis($kompetensi9->data_kompetensi->indikator) : '',
            ]);

            $kompetensiTeknis = $jabatan->kompetensi_teknis ?? collect();
            $values = [];

            // Jika data kosong atau null, isi dengan loop sebanyak 4 kali data kosong
            if ($kompetensiTeknis->isEmpty()) {
                for ($i = 10; $i < 13; $i++) {
                    $values[] = [
                        'no_teknis' => $i,
                        'nama_kompetensi_teknis' => '',
                        'level_teknis' => '',
                        'deskripsi_teknis' => '',
                        'indikator_teknis' => '',
                    ];
                }
            } else {
                // Jika data tersedia, lakukan iterasi seperti biasa
                foreach ($kompetensiTeknis as $index => $teknis) {
                    $values[] = [
                        'no_teknis' => $index + 10,
                        'nama_kompetensi_teknis' =>
                        isset($teknis) ? $LaporanController->clean_data($teknis->nama_kompetensi) : '',
                        'level_teknis' => $teknis->level ?? '',
                        'deskripsi_teknis' => isset($teknis) ? $LaporanController->clean_data($teknis->deskripsi) : '',
                        'indikator_teknis' => isset($teknis) ? $LaporanController->processIndikatorTeknis($teknis->indikator) : '',
                    ];
                }
            }

            $templateProcessor->cloneRowAndSetValues('no_teknis', $values);

            // Set general values
            $templateProcessor->setValues([
                'ikhtisar' => $LaporanController->clean_data($jabatan->datajabatan->ikhtisar),
                'nama_jabatan' => $LaporanController->clean_data($jabatan->datajabatan->nama_jabatan),
                // 'kode_jabatan' => $LaporanController->clean_data($jabatan->kode_jabatan),
                'kode_jabatan' => "",
                'pdd_formal' => $LaporanController->clean_data($jabatan->datajabatan->pdd_formal),
                'pdd_jurusan' => $LaporanController->clean_data($jabatan->datajabatan->pdd_jurusan),
                'pelatihan_struktural' => $LaporanController->clean_data($jabatan->datajabatan->pelatihan_struktural),
                'pelatihan_fungsional' => $LaporanController->clean_data($jabatan->datajabatan->pelatihan_fungsional),
                'pelatihan_teknis' => $LaporanController->clean_data($jabatan->datajabatan->pelatihan_teknis),
                'pengalaman_kerja' => $LaporanController->clean_data($jabatan->datajabatan->pengalaman_kerja),
            ]);

            // Set standard kompetensi values
            $standarKompetensi = $jabatan->standarkompetensi;
            $kelompokJabatan = $standarKompetensi->kelompok_jabatan ?? '';
            $templateProcessor->setValues([
                'pangkat' => $standarKompetensi->pangkat ?? '',
                'urusan_pemerintahan' => $standarKompetensi->urusan_pemerintahan ?? '',
                'kelompok_jabatan' => $kelompokJabatan,
                'kelompok_jabatan_tabel' => strtoupper($kelompokJabatan) ?? '',
                'indikator_kinerja' => isset($standarKompetensi) ? $LaporanController->clean_data($standarKompetensi->indikator_kinerja) : '',
            ]);

            $pathToSave = $directoryPath . '/' . $dinas_id . '. [' . $jabatan->kode_jabatan . '] ' . $namaJabatanFile . '.docx';
            $templateProcessor->saveAs($pathToSave);
        }

        $response = LaporanOPDController::downloadZip('kompetensi/' . $dinas_id . ' ' . $dinas->nama_dinas, $dinas_id . '. Standar Kompetensi Jabatan [' . $dinas->nama_dinas . ']');

        return $response;
    }

    public function faktorJabatan($dinas_id)
    {

        $dinas = Dinas::where('id', $dinas_id)->first();
        $jabatans = HubunganJabatan::with('data_faktor.data_faktor', 'datajabatan', 'data_tugas_pokok')
            ->where('dinas_id', $dinas_id)
            ->get();
        // dd(auth()->user()->role);

        cekAksesUser($dinas_id);

        $directoryPath = public_path($dinas_id . ' ' . $dinas->nama_dinas);
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        foreach ($jabatans as $jabatan) {
            $namaJabatanFile = str_replace('/', ' atau ', $jabatan->datajabatan->nama_jabatan);
            $dataFaktorCount = $jabatan->data_faktor->count();
            $templateFile = null;

            if ($dataFaktorCount == 7) {
                $templateFile = 'template/InformasiFaktorJabatanSturktural.docx';
            } elseif ($dataFaktorCount == 9) {
                $templateFile = 'template/InformasiFaktorJabatanFungsional.docx';
            }

            if ($templateFile) {
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFile);

                $uraianTugas = $jabatan->data_tugas_pokok->map(function ($item, $key) {
                    return ($key + 1) . '. ' . $item->uraian_tugas;
                })->implode('<w:br/>');

                if (empty($uraianTugas)) {
                    $uraianTugas = 'Tidak ada Data, Silahkan hubungin admin';
                }

                $templateProcessor->setValues([
                    'nama_jabatan' => $jabatan->datajabatan->nama_jabatan,
                    'unit_organisasi' => $jabatan->datajabatan->nama_unit,
                    'ikhtisar' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->ikhtisar),
                    'tanggung_jawab' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->tanggung_jawab),
                    'hasil_kerja' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->hasil_kerja_jabatan),
                    'uraian_tugas' => $uraianTugas,
                ]);

                if ($dataFaktorCount == 9) {
                    $templateProcessor->setValue('jenis_jabatan', strtoupper($jabatan->datajabatan->jenis_jabatan));
                }

                $faktorValues = $jabatan->data_faktor->mapWithKeys(function ($item, $key) {
                    return [
                        'tingkat#' . ($key + 1) => $item->data_faktor->nama_faktor,
                        'nilai#' . ($key + 1) => $item->data_faktor->nilai,
                        'indikator#' . ($key + 1) => str_replace("\n", '<w:br/>', $item->data_faktor->indikator)
                    ];
                })->all();

                $total = $jabatan->data_faktor->sum('data_faktor.nilai');

                $templateProcessor->setValues(array_merge($faktorValues, [
                    'total' => $total,
                    'kelas' => kelasjabatan1($total),
                    'rangekelas' => rangekelas($total),
                ]));

                $pathToSave = $directoryPath . '/' . $dinas_id . '. [' . $jabatan->kode_jabatan . '] ' . $namaJabatanFile . '.docx';
                $templateProcessor->saveAs($pathToSave);
            } else {
                $fileName = $dinas_id . '. [' . $jabatan->kode_jabatan . '] ' . $namaJabatanFile . ' [KOSONG].txt';
                $filePath = $directoryPath . '/' . $fileName;
                $content = 'Data Belum Lengkap. Silahkan Hubungi Admin Terlebih Dahulu';
                File::put($filePath, $content);
            }
        }

        $response = LaporanOPDController::downloadZip($dinas_id . ' ' . $dinas->nama_dinas, $dinas_id . '. Informasi Faktor Jabatan [' . $dinas->nama_dinas . ']');

        return $response;
    }

    public function faktorJabatanAll()
    {
        $dinass = Dinas::all();
        $templatePath = 'template/';

        foreach ($dinass as $dinas) {
            $jabatans = HubunganJabatan::with('data_faktor.data_faktor', 'datajabatan', 'data_tugas_pokok')
                ->where('dinas_id', $dinas->id)
                ->get();

            foreach ($jabatans as $jabatan) {
                $namaJabatanFile = str_replace('/', ' atau ', $jabatan->datajabatan->nama_jabatan);
                $dataFaktorCount = $jabatan->data_faktor->count();

                if ($dataFaktorCount == 7 || $dataFaktorCount == 9) {
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(
                        $templatePath . ($dataFaktorCount == 7 ? 'InformasiFaktorJabatanSturktural.docx' : 'InformasiFaktorJabatanFungsional.docx')
                    );

                    $values = $jabatan->data_tugas_pokok->map(function ($index, $i) {
                        return ($i + 1) . '. ' . $index->uraian_tugas;
                    })->all();

                    if ($values == NULL) {
                        $values[] = 'Tidak ada Data, Silahkan hubungin admin';
                    }

                    $templateProcessor->setValues([
                        'nama_jabatan' => $jabatan->datajabatan->nama_jabatan,
                        'unit_organisasi' => $jabatan->datajabatan->nama_unit,
                        'ikhtisar' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->ikhtisar),
                        'tanggung_jawab' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->tanggung_jawab),
                        'hasil_kerja' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->hasil_kerja_jabatan),
                        'uraian_tugas' => implode('<w:br/>', $values),
                    ]);

                    if ($dataFaktorCount == 9) {
                        $templateProcessor->setValue('jenis_jabatan', strtoupper($jabatan->datajabatan->jenis_jabatan));
                    }

                    $total = 0;
                    foreach ($jabatan->data_faktor as $index => $data_faktor) {
                        $templateProcessor->setValues([
                            'tingkat#' . ($index + 1) => $data_faktor->data_faktor->nama_faktor,
                            'nilai#' . ($index + 1) => $data_faktor->data_faktor->nilai,
                            'indikator#' . ($index + 1) => str_replace("\n", '<w:br/>', $data_faktor->data_faktor->indikator),
                        ]);
                        $total += $data_faktor->data_faktor->nilai;
                    }

                    $templateProcessor->setValues([
                        'total' => $total,
                        'kelas' => kelasjabatan1($total),
                        'rangekelas' => rangekelas($total),
                    ]);

                    $directoryPath = public_path('informasifaktor/' . $dinas->id . '. ' . $dinas->nama_dinas);
                    if (!File::exists($directoryPath)) {
                        File::makeDirectory($directoryPath, 0755, true);
                    }

                    $pathToSave = $directoryPath . '/' . $dinas->id . '. [' . $jabatan->kode_jabatan . '] ' . $namaJabatanFile . '.docx';
                    $templateProcessor->saveAs($pathToSave);
                } else {
                    $directoryPath = public_path('informasifaktor/' . $dinas->id . '. ' . $dinas->nama_dinas);
                    if (!File::exists($directoryPath)) {
                        File::makeDirectory($directoryPath, 0755, true);
                    }

                    $fileName = $dinas->id . '. [' . $jabatan->kode_jabatan . '] ' . $namaJabatanFile . ' [KOSONG].txt';
                    $filePath = $directoryPath . '/' . $fileName;
                    $content = 'Data Belum Lengkap. Silahkan Hubungi Admin Terlebih Dahulu';
                    File::put($filePath, $content);
                }
            }
        }

        $response = LaporanOPDController::downloadZip('informasifaktor', 'Informasi Faktor Jabatan seluruh OPD');
        return $response;
    }
}
