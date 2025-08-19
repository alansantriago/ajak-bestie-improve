<?php

namespace App\Http\Controllers;

use App\Exports\HubunganJabatanExport;
use App\Exports\RekapBiodataExport;
use App\Models\BiodataJabatanModel;
use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use vendor\phpoffice\phpword;
class LaporanController extends Controller
{
    public function processIndikatorTeknis($text)
    {
        // Pecah teks berdasarkan angka dengan pola 5.1 atau 5.1.
        $parts = preg_split('/(?=\d+\.\d+\.?)/', $text);

        // Hapus karakter kontrol non-printable (ASCII 0 - 31 dan ASCII 127)
        $parts = preg_replace('/[\x00-\x1F\x7F]/', ' ', $parts);

        // Template untuk paragraf dengan indentasi hanya di baris berikutnya
        $paragraphTemplate = '<w:p><w:pPr><w:ind w:left="360" w:hanging="360"/><w:jc w:val="both"/></w:pPr><w:r><w:t>%s</w:t></w:r></w:p>';
        // Iterasi melalui setiap bagian, bungkus dengan template paragraf
        $result = '';
        foreach ($parts as $part) {
            if (trim($part) !== '') { // Abaikan bagian kosong
                $result .= sprintf($paragraphTemplate, htmlspecialchars($part));
            }
        }

        return $result;
    }
    public function clean_data($data)
    {
        // Ganti '&' dengan 'dan' dan newline (\n, \r\n, \r) dengan '<w:br/>'
        $final_data = preg_replace('/\r\n|\r|\n/', '<w:br/>', $data);
        $final_data = str_replace('&', 'dan', $final_data);

        // Hapus karakter kontrol non-printable (ASCII 0 - 31 dan ASCII 127)
        $cleaned_data = preg_replace('/[\x00-\x1F\x7F]/', ' ', $final_data);

        return $cleaned_data;
    }
    public function standarkompetensi($kode_jabatan)
    {
        $jabatan = HubunganJabatan::with('data_kompetensi.data_kompetensi', 'datajabatan', 'kompetensi_teknis', 'standarkompetensi')->where('kode_jabatan', $kode_jabatan)->first();
        if ($jabatan->standarkompetensi === null) {
            if (in_array(auth()->user()->role, ['admin', 'superadmin'])) {
                return redirect()->to('/standar-kompetensi/' . $jabatan->datajabatan->id . '/edit')->with('Errors', 'Tidak bisa download laporan. Silahkan isi data terlebih Dahulu');
            } else {
                return redirect()->back()->with('Errors', 'Data Master Standar Kompetensi Jabatan Belum Lengkap. Silahkan hubungi admin');
            }
        }

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/StandarKompetensiJabatan.docx');

        // Process data_kompetensi
        $dataKompetensi = $jabatan->data_kompetensi ?? collect();
        $values = [];
        for ($i = 0; $i < 8; $i++) {
            $kompetensi = $dataKompetensi->get($i);
            $values[] = [
                'no' => $i + 1,
                'nama_kompetensi' => $kompetensi->data_kompetensi->nama_kompetensi ?? '',
                'level' => $kompetensi->data_kompetensi->level ?? '',
                'deskripsi' => isset($kompetensi) ? LaporanController::clean_data($kompetensi->data_kompetensi->deskripsi) : '',
                'indikator' => isset($kompetensi) ? LaporanController::processIndikatorTeknis($kompetensi->data_kompetensi->indikator) : '',
            ];
        }

        $templateProcessor->cloneRowAndSetValues('no', $values);

        // Set values for the 9th competency if available
        $kompetensi9 = $dataKompetensi->get(8);
        $templateProcessor->setValues([
            'no#9' => '9',
            'nama_kompetensi#9' => $kompetensi9->data_kompetensi->nama_kompetensi ?? '',
            'level#9' => $kompetensi9->data_kompetensi->level ?? '',
            'deskripsi#9' => isset($kompetensi9) ? LaporanController::clean_data($kompetensi9->data_kompetensi->deskripsi) : '',
            'indikator#9' => isset($kompetensi9) ? LaporanController::processIndikatorTeknis($kompetensi9->data_kompetensi->indikator) : '',
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
                    isset($teknis) ? LaporanController::clean_data($teknis->nama_kompetensi) : '',
                    'level_teknis' => $teknis->level ?? '',
                    'deskripsi_teknis' => isset($teknis) ? LaporanController::clean_data($teknis->deskripsi) : '',
                    'indikator_teknis' => isset($teknis) ? LaporanController::processIndikatorTeknis($teknis->indikator) : '',

                ];
            }
        }

        $templateProcessor->cloneRowAndSetValues('no_teknis', $values);

        // Set general values
        $templateProcessor->setValues([
            'ikhtisar' => LaporanController::clean_data($jabatan->datajabatan->ikhtisar),
            'nama_jabatan' => LaporanController::clean_data($jabatan->datajabatan->nama_jabatan),
            // 'kode_jabatan' => LaporanController::clean_data($jabatan->kode_jabatan),
            'kode_jabatan' => "",
            'pdd_formal' => LaporanController::clean_data($jabatan->datajabatan->pdd_formal),
            'pdd_jurusan' => LaporanController::clean_data($jabatan->datajabatan->pdd_jurusan),
            'pelatihan_struktural' => LaporanController::clean_data($jabatan->datajabatan->pelatihan_struktural),
            'pelatihan_fungsional' => LaporanController::clean_data($jabatan->datajabatan->pelatihan_fungsional),
            'pelatihan_teknis' => LaporanController::clean_data($jabatan->datajabatan->pelatihan_teknis),
            'pengalaman_kerja' => LaporanController::clean_data($jabatan->datajabatan->pengalaman_kerja),
        ]);

        // Set standard kompetensi values
        $standarKompetensi = $jabatan->standarkompetensi;
        $kelompokJabatan = $standarKompetensi->kelompok_jabatan ?? '';
        $templateProcessor->setValues([
            'pangkat' => $standarKompetensi->pangkat ?? '',
            'urusan_pemerintahan' => $standarKompetensi->urusan_pemerintahan ?? '',
            'kelompok_jabatan' => $kelompokJabatan,
            'kelompok_jabatan_tabel' => strtoupper($kelompokJabatan) ?? '',
            'indikator_kinerja' => isset($standarKompetensi) ? LaporanController::clean_data($standarKompetensi->indikator_kinerja) : '',
        ]);

        $pathToSave = '3. [' . $jabatan->kode_jabatan . '] ' . $jabatan->datajabatan->nama_jabatan . '.docx'; // Menggantikan simbol '/' dan '\' dengan spasi
        $pathToSave = str_replace(['/', '\\'], ' ', $pathToSave);
        $templateProcessor->saveAs($pathToSave);
        return response()->download($pathToSave)->deleteFileAfterSend(true);
    }
    public function informasiJabatan($kode_jabatan)
    {

        $jabatan = HubunganJabatan::with('data_faktor.data_faktor', 'data_syarat', 'data_lingkungan', 'data_korelasi', 'datajabatan', 'data_tugas_pokok', 'data_bahan_kerja', 'data_beban_kerja', 'data_perangkat_kerja')->where('kode_jabatan', $kode_jabatan)->first();
        //   dd($jabatan->data_tugas_pokok[0]['tingkat']);
        // dd(new \PhpOffice\PhpWord\TemplateProcessor('template/InformasiJabatan.docx'));
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/InformasiJabatan.docx');


        $templateProcessor->setValues(array(
            'ikhtisar' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->ikhtisar),
            'nama_jabatan' => $jabatan->datajabatan->nama_jabatan,
            'kode_jabatan' => $jabatan->kode_jabatan,
            'jpt_madya' => preg_replace('/^kepala\s+/i', '', $jabatan->jpt_madya),
            'jpt_pratama' => preg_replace('/^kepala\s+/i', '', $jabatan->jpt_pratama),
            'administrator' => preg_replace('/^kepala\s+/i', '', $jabatan->administrator),
            'pengawas' => preg_replace('/^kepala\s+/i', '', $jabatan->pengawas),
            'pdd_formal' => $jabatan->datajabatan->pdd_formal,
            'pdd_jurusan' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->pdd_jurusan),
            'pelatihan_struktural' => $jabatan->datajabatan->pelatihan_struktural,
            'pelatihan_fungsional' => $jabatan->datajabatan->pelatihan_fungsional,
            'pelatihan_teknis' => $jabatan->datajabatan->pelatihan_teknis,
            'pengalaman_kerja' => $jabatan->datajabatan->pengalaman_kerja,
            'hasil_kerja_jabatan' => str_replace("\n", '</w:t><w:br/><w:t>', $jabatan->datajabatan->hasil_kerja_jabatan),
            'tanggung_jawab' => str_replace("\n", '</w:t><w:br/><w:t>', $jabatan->datajabatan->tanggung_jawab),
            'wewenang' => str_replace("\n", '<w:br/>', $jabatan->datajabatan->wewenang),
            'prestasi_harapan' => str_replace("\n", '</w:t><w:br/><w:t>', $jabatan->datajabatan->prestasi_harapan),
        ));
        //Isi data table Tugas Pokok
        $values = [];
        if ($jabatan->data_tugas_pokok->first() == NULL) {
            $i = 0;
            while ($i < 10) {
                array_push($values, ['tp_tingkat' => $i + 1, 'tp_uraian_tugas' => '', 'tp_hasil_kerja' => '', 'tp_hasil' => '', 'tp_penyelesaian' => '', 'tp_kebutuhan' => '']);
                $i++;
            }
        }
        $i = 0;
        $tp_total = 0;
        foreach ($jabatan->data_beban_kerja as $index) {
            array_push($values, ['tp_tingkat' => $jabatan->data_tugas_pokok[$i]['tingkat'], 'tp_uraian_tugas' => $jabatan->data_tugas_pokok[$i]['uraian_tugas'], 'tp_hasil_kerja' => $jabatan->data_tugas_pokok[$i]['hasil_kerja'], 'tp_hasil' => $index->jumlah_hasil, 'tp_penyelesaian' => $index->penyelesaian, 'tp_kebutuhan' => ($index->penyelesaian / 1250) * $index->jumlah_hasil,]);
            $i++;
            $tp_total += ($index->penyelesaian / 1250) * $index->jumlah_hasil;
        }
        while ($i < $jabatan->data_tugas_pokok->count()) {
            array_push($values, ['tp_tingkat' => $jabatan->data_tugas_pokok[$i]['tingkat'], 'tp_uraian_tugas' => $jabatan->data_tugas_pokok[$i]['uraian_tugas'], 'tp_hasil_kerja' => $jabatan->data_tugas_pokok[$i]['hasil_kerja'], 'tp_hasil' => '', 'tp_penyelesaian' => '', 'tp_kebutuhan' => '']);
            $i++;
        }

        if ($jabatan->total_beban_kerja != null) {
            $tp_total = $jabatan->total_beban_kerja;
        }

        $templateProcessor->setValue('tp_total', round($tp_total, 3));
        $templateProcessor->setValue('tp_pegawai', round($tp_total, 0, PHP_ROUND_HALF_EVEN));
        $templateProcessor->cloneRowAndSetValues('tp_tingkat', $values);
        // Isi Data Bahan Kerja
        $values = [];
        if ($jabatan->data_bahan_kerja->first() == NULL) {
            $i = 0;
            while ($i < 10) {
                array_push($values, ['bk_tingkat' => $i + 1, 'bahan_kerja' => '', 'bk_penggunaan' => '']);
                $i++;
            }
        } else {
            $i = 0;
            foreach ($jabatan->data_bahan_kerja as $index) {
                array_push($values, ['bk_tingkat' => $index->tingkat, 'bahan_kerja' => $index->bahan_kerja, 'bk_penggunaan' => $index->penggunaan_bahan]);
                $i++;
            }
            while ($i < 10) {
                array_push($values, ['bk_tingkat' => $i + 1, 'bahan_kerja' => '', 'bk_penggunaan' => '']);
                $i++;
            }
        }
        $templateProcessor->cloneRowAndSetValues('bk_tingkat', $values);

        // Isi Data Perangkat Kerja
        $values = [];
        if ($jabatan->data_perangkat_kerja->first() == NULL) {
            $i = 0;
            while ($i < 10) {
                array_push($values, ['pk_tingkat' => $i + 1, 'perangkat_kerja' => '', 'pk_penggunaan' => '']);
                $i++;
            }
        } else {
            $i = 0;
            foreach ($jabatan->data_perangkat_kerja as $index) {
                array_push($values, ['pk_tingkat' => $index->tingkat, 'perangkat_kerja' => $index->perangkat_kerja, 'pk_penggunaan' => $index->penggunaan]);
                $i++;
            }
            while ($i < 10) {
                array_push($values, ['pk_tingkat' => $i + 1, 'perangkat_kerja' => '', 'bk_penggunaan' => '']);
                $i++;
            }
        }
        $templateProcessor->cloneRowAndSetValues('pk_tingkat', $values);

        // Isi Data Korelasi
        $values = [];
        if ($jabatan->data_korelasi->first() == NULL) {
            $i = 0;
            while ($i < 3) {
                array_push($values, ['kj_tingkat' => $i + 1, 'kj_nama_jabatan' => '', 'kj_unit_kerja' => '', 'kj_deskripsi' => '']);
                $i++;
            }
        } else {
            $i = 0;
            foreach ($jabatan->data_korelasi as $index) {
                array_push($values, ['kj_tingkat' => $i + 1, 'kj_nama_jabatan' => $index->nama_jabatan, 'kj_unit_kerja' => $index->unit_kerja, 'kj_deskripsi' => $index->deskripsi]);
                $i++;
            }
            while ($i < 3) {
                array_push($values, ['kj_tingkat' => $i + 1, 'kj_nama_jabatan' => '', 'kj_unit_kerja' => '', 'kj_deskripsi' => '']);
                $i++;
            }
        }
        $templateProcessor->cloneRowAndSetValues('kj_tingkat', $values);
        // Data Lingkungan
        if ($jabatan->data_lingkungan != NULL) {
            $templateProcessor->setValues(array(
                'lk_dalam' => $jabatan->data_lingkungan->tempat_kerja,
                'lk_luar' => 100 - $jabatan->data_lingkungan->tempat_kerja,
                'lk_suhu' => $jabatan->data_lingkungan->suhu,
                'lk_udara' => $jabatan->data_lingkungan->udara,
                'lk_ruangan' => $jabatan->data_lingkungan->keadaan_ruangan,
                'lk_letak' => $jabatan->data_lingkungan->letak,
                'lk_penerangan' => $jabatan->data_lingkungan->penerangan,
                'lk_suara' => $jabatan->data_lingkungan->suara,
                'lk_keadaan' => $jabatan->data_lingkungan->keadaan_tempat_kerja,
                'lk_getaran' => $jabatan->data_lingkungan->getaran,
                'lk_fisik' => $jabatan->data_lingkungan->fisik,
                'lk_mental' => $jabatan->data_lingkungan->mental,
                'lk_bakat' => $jabatan->data_lingkungan->bakat,
            ));
        } else {
            $templateProcessor->setValues(array(
                'lk_dalam' => NULL,
                'lk_luar' => NULL,
                'lk_suhu' => NULL,
                'lk_udara' => NULL,
                'lk_ruangan' => NULL,
                'lk_letak' => NULL,
                'lk_penerangan' => NULL,
                'lk_suara' => NULL,
                'lk_keadaan' => NULL,
                'lk_getaran' => NULL,
                'lk_fisik' => NULL,
                'lk_mental' => NULL,
            ));
        }
        $kelasjabatan = 0;
        foreach ($jabatan->data_faktor as $index) {
            $kelasjabatan += $index->data_faktor->nilai;
        }
        // dd($kelasjabatan);
        // dd(hubungandata($jabatan->data_syarat->hubungan_data));
        if ($jabatan->data_syarat != NULL) {
            $templateProcessor->setValues(array(
                'sj_jenis_kelamin' => $jabatan->data_syarat->jenis_kelamin,
                'sj_umur' => $jabatan->data_syarat->umur,
                'sj_tinggi' => $jabatan->data_syarat->tinggi,
                'sj_berat' => $jabatan->data_syarat->berat,
                'sj_postur' => $jabatan->data_syarat->postur,
                'sj_penampilan' => $jabatan->data_syarat->penampilan,
                'sj_keterampilan' => str_replace("\n", '<w:br/>', $jabatan->data_syarat->keterampilan),
                'sj_upaya_fisik' =>  ucwords(str_replace(",", ', ', $jabatan->data_syarat->upaya_fisik)),
                'kelas_jabatan' => kelasjabatan1($kelasjabatan),
                'sj_hubungan_data' => implode('<w:br/>', hubungandata($jabatan->data_syarat->hubungan_data)),
                'sj_hubungan_benda' => implode('<w:br/>', hubunganbenda($jabatan->data_syarat->hubungan_benda)),
                'sj_hubungan_orang' => implode('<w:br/>', hubunganorang($jabatan->data_syarat->hubungan_orang)),
                'sj_bakat' => implode('<w:br/>', bakat($jabatan->data_syarat->bakat)),
                'sj_tempramen' => implode('<w:br/>', temperamen($jabatan->data_syarat->temperamen)),
                'sj_minat' => implode('<w:br/>', minat($jabatan->data_syarat->minat)),

            ));
        } else {
            $templateProcessor->setValues(array(
                'sj_jenis_kelamin' => NULL,
                'sj_umur' => NULL,
                'sj_tinggi' => NULL,
                'sj_berat' => NULL,
                'sj_postur' => NULL,
                'sj_penampilan' => NULL,
                'sj_keterampilan' => NULL,
                'sj_upaya_fisik' =>  NULL,
                'kelas_jabatan' => kelasjabatan1($kelasjabatan),
                'sj_hubungan_data' => NULL,
                'sj_hubungan_benda' => NULL,
                'sj_hubungan_orang' => NULL,
                'sj_bakat' => NULL,
                'sj_tempramen' => NULL,
                'sj_minat' => NULL,

            ));
        }
        // dd($jabatan->data_faktor);

        $pathToSave = '1. [' . $jabatan->kode_jabatan . '] ' . $jabatan->datajabatan->nama_jabatan . '.docx';
        // Menggantikan simbol '/' dan '\' dengan spasi
        $pathToSave = str_replace(['/', '\\'], ' ', $pathToSave);
        $templateProcessor->saveAs($pathToSave);
        return response()->download($pathToSave)->deleteFileAfterSend(true);
    }

    public function faktorJabatan($kode_jabatan)
    {
        $jabatan = HubunganJabatan::with('data_faktor.data_faktor', 'datajabatan', 'data_tugas_pokok')->where('kode_jabatan', $kode_jabatan)->first();
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
            $pathToSave = '2. [' . $jabatan->kode_jabatan . '] ' . $jabatan->datajabatan->nama_jabatan . '.docx'; // Menggantikan simbol '/' dan '\' dengan spasi
            $pathToSave = str_replace(['/', '\\'], ' ', $pathToSave);
            $templateProcessor->saveAs($pathToSave);
            return response()->download($pathToSave)->deleteFileAfterSend(true);
        } else {

            return redirect('/laporan-faktor-jabatan')->with('Errors', 'Data faktor tidak ada silahkan hubungin admin untuk isi data!');
            // return view('admin.laporan.indexfaktor', $data)->with('Errors', 'Data faktor tidak ada silahkan diisi terlebih dahulu!');
        }
    }
    public function rekapitulasi()
    {
        if (auth()->user()->role == 'user') {
            $user = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            return Excel::download(new HubunganJabatanExport, 'Rekapitulasi Jabatan [' . $user->dinas->nama_dinas . '].xlsx');
        } else {
            return Excel::download(new HubunganJabatanExport, 'Rekapitulasi Jabatan.xlsx');
        }
    }

    public function indexinformasijabatan()
    {
        if (auth()->user()->role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            $opd = Dinas::filter(request(['search']))->where('id', $dinas_id->dinas_id)->paginate(10)->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        }
        $data = [
            'opd' =>  $opd,
            'active' => 'laporan',
        ];
        return view('admin.laporan.indexjabatan', $data);
    }
    public function indexrekapabk()
    {
        if (auth()->user()->role == 'user') {
            $user = HakAksesModel::where('user_id', auth()->user()->id)->first();
            $jabatan = HubunganJabatan::with('datajabatan', 'data_faktor.data_faktor', 'data_kompetensi.data_kompetensi', 'standarkompetensi', 'data_beban_kerja', 'detaildinas')->filter(request(['search']))->where('dinas_id', $user->dinas_id)->orderBy('dinas_id', 'ASC')->orderBy('kode_jabatan', 'ASC')->paginate(20)->withQueryString();
        } else {
            $jabatan = HubunganJabatan::with('datajabatan', 'data_faktor.data_faktor', 'data_kompetensi.data_kompetensi', 'standarkompetensi', 'data_beban_kerja', 'detaildinas')->filter(request(['search']))->orderBy('dinas_id', 'ASC')->orderBy('kode_jabatan', 'ASC')->paginate(20)->withQueryString();
        }

        // dd($jabatan->first());
        return view('admin.laporan.indexrekap', [
            'jabatan' => $jabatan,
            'active' => 'laporan',
        ]);
    }
    public function indexfaktorjabatan()
    {
        if (auth()->user()->role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            $opd = Dinas::filter(request(['search']))->where('id', $dinas_id->dinas_id)->paginate(10)->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        }
        $data = [
            'opd' =>  $opd,
            'active' => 'laporan',
        ];
        return view('admin.laporan.indexfaktor', $data);
    }
    public function indexkompetensijabatan()
    {
        if (auth()->user()->role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            $opd = Dinas::filter(request(['search']))->where('id', $dinas_id->dinas_id)->paginate(10)->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        }
        $data = [
            'opd' =>  $opd,
            'active' => 'laporan',
        ];
        return view('admin.laporan.indexkompetensi', $data);
    }
    public function indexrekapbiodatajabatan()
    {
        if (auth()->user()->role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            $opd = Dinas::filter(request(['search']))->where('id', $dinas_id->dinas_id)->paginate(10)->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        }
        $data = [
            'opd' =>  $opd,
            'active' => 'laporan',
        ];
        return view('admin.laporan.indexbiodata', $data);
    }

    public function detailrekapbiodata($dinas_id)
    {
        cekAksesUser($dinas_id);
        $biodataJabatan = BiodataJabatanModel::whereHas('hubungan_jabatan_detail', function ($query) use ($dinas_id) {
            $query->where('dinas_id', $dinas_id);
        })->with(['hubungan_jabatan_detail.data_beban_kerja', 'hubungan_jabatan_detail.datajabatan', 'hubungan_jabatan_detail.get_parent.parent.datajabatan', 'hubungan_jabatan_detail.detaildinas'])->get();
        $opd = Dinas::where('id', $dinas_id)->first();

        return view('admin.laporan.detailrekapbiodata', [
            'biodataJabatan' => $biodataJabatan,
            'opd' => $opd,
            'active' => 'laporan',
        ]);
    }

    public function biodata($dinas_id, $allData = False)
    {
        cekAksesUser($dinas_id);
        $namaopd = Dinas::where('id', $dinas_id)->first()->nama_dinas;
        return Excel::download(new RekapBiodataExport($dinas_id, $allData), 'Rekap Biodata Jabatan [' . $namaopd . '].xlsx');
    }
    public function all_biodata($allData = False)
    {
        return Excel::download(new RekapBiodataExport(Null, $allData), 'Rekap Seluruh Biodata Jabatan.xlsx');
    }
}
