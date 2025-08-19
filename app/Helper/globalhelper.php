<?php

use App\Models\BiodataJabatanModel;
use App\Models\HakAksesModel;
use App\Models\Kompetensi;
use App\Models\Dinas;
use App\Models\Faktor;
use App\Models\FaktorJabatan;
use App\Models\HubunganJabatan;
use App\Models\Jabatan;
use App\Models\Manajerial;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

if (!function_exists('cariaksesdinas')) {
    function cariaksesdinas($id)
    {
        $user = HakAksesModel::with('dinas')->where('user_id', $id)->first();
        // dd($user->dinas);
        return $user->dinas;
    }
};
if (!function_exists('daftardinasselect')) {
    function daftardinasselect()
    {
        $dinas = Dinas::orderBy('nama_dinas', 'ASC')->get();

        return $dinas;
    }
};
if (!function_exists('kompetensi')) {
    function kompetensi($nama_kopetensi)
    {
        return Kompetensi::where('nama_kompetensi', $nama_kopetensi)->orderBy('level', 'ASC')->get();
    }
};
if (!function_exists('faktor9')) {
    function faktor9($faktor)
    {
        return FaktorJabatan::where('jenis_jabatan', '9 Faktor')->where('tingkat', $faktor)->orderBy('nama_faktor', 'ASC')->get();
    }
};
if (!function_exists('faktor6')) {
    function faktor6($faktor)
    {
        return FaktorJabatan::where('jenis_jabatan', '6 Faktor')->where('tingkat', $faktor)->orderBy('nama_faktor', 'ASC')->get();
    }
};
if (!function_exists('kelasjabatan1')) {
    function kelasjabatan1($nilai)
    {
        if ($nilai >= 190 && $nilai <= 240) {
            return "Kelas 1";
        } else if ($nilai > 240 && $nilai <= 300) {
            return "Kelas 2";
        } else if ($nilai > 300 && $nilai <= 370) {
            return "Kelas 3";
        } else if ($nilai > 370 && $nilai <= 450) {
            return "Kelas 4";
        } else if ($nilai > 450 && $nilai <= 650) {
            return "Kelas 5";
        } else if ($nilai > 650 && $nilai <= 850) {
            return "Kelas 6";
        } else if ($nilai > 850 && $nilai <= 1100) {
            return "Kelas 7";
        } else if ($nilai > 1100 && $nilai <= 1350) {
            return "Kelas 8";
        } else if ($nilai > 1350 && $nilai <= 1600) {
            return "Kelas 9";
        } else if ($nilai > 1600 && $nilai <= 1850) {
            return "Kelas 10";
        } else if ($nilai > 1850 && $nilai <= 2100) {
            return "Kelas 11";
        } else if ($nilai > 2100 && $nilai <= 2350) {
            return "Kelas 12";
        } else if ($nilai > 2350 && $nilai <= 2750) {
            return "Kelas 13";
        } else if ($nilai > 2750 && $nilai <= 3150) {
            return "Kelas 14";
        } else if ($nilai > 3150 && $nilai <= 3600) {
            return "Kelas 15";
        } else if ($nilai > 3600 && $nilai <= 4050) {
            return "Kelas 16";
        } else if ($nilai > 4050) {
            return "Kelas 17";
        } else {
            return "Tidak ada data";
        }
    }
};
if (!function_exists('kelasjabatan2')) {
    function kelasjabatan2($nilai)
    {
        if ($nilai >= 190 && $nilai <= 240) {
            return "Kelas 1";
        } else if ($nilai > 240 && $nilai <= 300) {
            return "Kelas 2";
        } else if ($nilai > 300 && $nilai <= 370) {
            return "Kelas 3";
        } else if ($nilai > 370 && $nilai <= 450) {
            return "Kelas 4";
        } else if ($nilai > 450 && $nilai <= 650) {
            return "Kelas 5";
        } else if ($nilai > 650 && $nilai <= 850) {
            return "Kelas 6";
        } else if ($nilai > 850 && $nilai <= 1100) {
            return "Kelas 7";
        } else if ($nilai > 1100 && $nilai <= 1350) {
            return "Kelas 8";
        } else if ($nilai > 1350 && $nilai <= 1600) {
            return "Kelas 9";
        } else if ($nilai > 1600 && $nilai <= 1850) {
            return "Kelas 10";
        } else if ($nilai > 1850 && $nilai <= 2100) {
            return "Kelas 11";
        } else if ($nilai > 2100 && $nilai <= 2350) {
            return "Kelas 12";
        } else if ($nilai > 2350 && $nilai <= 2750) {
            return "Kelas 13";
        } else if ($nilai > 2750 && $nilai <= 3150) {
            return "Kelas 14";
        } else if ($nilai > 3150 && $nilai <= 3600) {
            return "Kelas 15";
        } else if ($nilai > 3600 && $nilai <= 4050) {
            return "Kelas 16";
        } else if ($nilai > 4050) {
            return "Kelas 17";
        } else {
            return "";
        }
    }
};
if (!function_exists('rangekelas')) {
    function rangekelas($nilai)
    {
        if ($nilai >= 190 && $nilai <= 240) {
            return "190 s/d 240";
        } else if ($nilai > 240 && $nilai <= 300) {
            return "245 s/d 300";
        } else if ($nilai > 300 && $nilai <= 370) {
            return "305 s/d 370";
        } else if ($nilai > 370 && $nilai <= 450) {
            return "375 s/d 450";
        } else if ($nilai > 450 && $nilai <= 650) {
            return "455 s/d 650";
        } else if ($nilai > 650 && $nilai <= 850) {
            return "655 s/d 850";
        } else if ($nilai > 850 && $nilai <= 1100) {
            return "855 s/d 1100";
        } else if ($nilai > 1100 && $nilai <= 1350) {
            return "1105 s/d 1350";
        } else if ($nilai > 1350 && $nilai <= 1600) {
            return "1355 s/d 1600";
        } else if ($nilai > 1600 && $nilai <= 1850) {
            return "1605 s/d 1850";
        } else if ($nilai > 1850 && $nilai <= 2100) {
            return "1855 s/d 2100";
        } else if ($nilai > 2100 && $nilai <= 2350) {
            return "2105 s/d 2350";
        } else if ($nilai > 2350 && $nilai <= 2750) {
            return "2355 s/d 2750";
        } else if ($nilai > 2750 && $nilai <= 3150) {
            return "2755 s/d 3150";
        } else if ($nilai > 3150 && $nilai <= 3600) {
            return "3155 s/d 3600";
        } else if ($nilai > 3600 && $nilai <= 4050) {
            return "3605 s/d 4050";
        } else if ($nilai > 4050) {
            return "4055 s/d ke atas ";
        } else {
            return "Tidak ada data";
        }
    }
};

if (!function_exists('jenjang_pendidikan')) {
    function jenjang_pendidikan()
    {
        $jenjang_pendidikan = [
            (object)['value' => 'SD', 'text' => 'SD'],
            (object)['value' => 'SMP', 'text' => 'SMP'],
            (object)['value' => 'SMA', 'text' => 'SMA'],
            (object)['value' => 'D1', 'text' => 'D1'],
            (object)['value' => 'D2', 'text' => 'D2'],
            (object)['value' => 'D3', 'text' => 'D3'],
            (object)['value' => 'D4', 'text' => 'D4'],
            (object)['value' => 'S1', 'text' => 'S1'],
            (object)['value' => 'S2', 'text' => 'S2'],
            (object)['value' => 'S3', 'text' => 'S3'],
        ];
        return $jenjang_pendidikan;
    }
};

if (!function_exists('golongan_pns')) {
    function golongan_pns()
    {
        $options = [
            [
                'value' => 'Juru Muda / (I.a)',
                'text' => 'Juru Muda / <Strong>(I.a)</Strong>',
            ],
            [
                'value' => 'Juru Muda Tk. I (I.b)',
                'text' => 'Juru Muda Tk. I / <Strong>(I.b)</Strong>',
            ],
            [
                'value' => 'Juru / (I.c)',
                'text' => 'Juru / <Strong>(I.c)</Strong>',
            ],
            [
                'value' => 'Juru Tk. I / (I.d)',
                'text' => 'Juru Tk. I / <Strong>(I.d)</Strong>',
            ],
            [
                'value' => 'Pengatur Muda / (II.a)',
                'text' => 'Pengatur Muda / <Strong>(II.a)</Strong>',
            ],
            [
                'value' => 'Pengatur Muda Tk I (II.b)',
                'text' => 'Pengatur Muda Tk I / <Strong>(II.b)</Strong>',
            ],
            [
                'value' => 'Pengatur / (II.c)',
                'text' => 'Pengatur / <Strong>(II.c)</Strong>',
            ],
            [
                'value' => 'Pengatur Tk I / (II.d)',
                'text' => 'Pengatur Tk I / <Strong>(II.d)</Strong>',
            ],
            [
                'value' => 'Penata Muda / (III.a)',
                'text' => 'Penata Muda / <Strong>(III.a)</Strong>',
            ],
            [
                'value' => 'Penata Muda Tk. I / (III.b)',
                'text' => 'Penata Muda Tk. I / <Strong>(III.b)</Strong>',
            ],
            [
                'value' => 'Penata / (III.c)',
                'text' => 'Penata / <Strong>(III.c)</Strong>',
            ],
            [
                'value' => 'Penata Tk. I / (III.d)',
                'text' => 'Penata Tk. I / <Strong>(III.d)</Strong>',
            ],
            [
                'value' => 'Pembina / (IV.a)',
                'text' => 'Pembina / <Strong>(IV.a)</Strong>',
            ],
            [
                'value' => 'Pembina Tk. I / (IV.b)',
                'text' => 'Pembina Tk. I / <Strong>(IV.b)</Strong>',
            ],
            [
                'value' => 'Pembina Utama Muda / (IV.c)',
                'text' => 'Pembina Utama Muda / <Strong>(IV.c)</Strong>',
            ],
            [
                'value' => 'Pembina Utama Madya / (IV.d)',
                'text' => 'Pembina Utama Madya / <Strong>(IV.d)</Strong>'
            ],
        ];
        // Mengonversi array menjadi array objek
        $objek = [];
        foreach ($options as $item) {
            $objek[] = (object) $item;
        }
        return $objek;
    }
};
if (!function_exists('kelasjabatan')) {
    function kelasjabatan($nilai)
    {
        if ($nilai >= 190 && $nilai <= 240) {
            echo "Kelas 1";
        } else if ($nilai > 240 && $nilai <= 300) {
            echo "Kelas 2";
        } else if ($nilai > 300 && $nilai <= 370) {
            echo "Kelas 3";
        } else if ($nilai > 370 && $nilai <= 450) {
            echo "Kelas 4";
        } else if ($nilai > 450 && $nilai <= 650) {
            echo "Kelas 5";
        } else if ($nilai > 650 && $nilai <= 850) {
            echo "Kelas 6";
        } else if ($nilai > 850 && $nilai <= 1100) {
            echo "Kelas 7";
        } else if ($nilai > 1100 && $nilai <= 1350) {
            echo "Kelas 8";
        } else if ($nilai > 1350 && $nilai <= 1600) {
            echo "Kelas 9";
        } else if ($nilai > 1600 && $nilai <= 1850) {
            echo "Kelas 10";
        } else if ($nilai > 1850 && $nilai <= 2100) {
            echo "Kelas 11";
        } else if ($nilai > 2100 && $nilai <= 2350) {
            echo "Kelas 12";
        } else if ($nilai > 2350 && $nilai <= 2750) {
            echo "Kelas 13";
        } else if ($nilai > 2750 && $nilai <= 3150) {
            echo "Kelas 14";
        } else if ($nilai > 3150 && $nilai <= 3600) {
            echo "Kelas 15";
        } else if ($nilai > 3600 && $nilai <= 4050) {
            echo "Kelas 16";
        } else if ($nilai > 4050) {
            echo "Kelas 17";
        } else {
            echo "Data masih Kurang / Tidak ada data";
        }
    }
};
if (!function_exists('namadinas')) {
    function namadinas($id_user)
    {
        $user = HakAksesModel::with('dinas')->where('user_id', $id_user)->first();
        echo $user->dinas->nama_dinas;
    }
};
if (!function_exists('standarkompetensi')) {
    function standarkompetensi($nama_kopetensi)
    {
        return Manajerial::where('nama_kompetensi', $nama_kopetensi)->orderBy('level', 'ASC')->get();
    }
};
if (!function_exists('faktorjabatan')) {
    function faktorjabatan($id)
    {

        $faktor = Faktor::with('data_faktor')->where('jabatan_id', $id)->get();
        // foreach ($faktor as $p) {
        //     $data[] = $p->faktorjabatan_id;
        // }
        return $faktor;
    }
};
if (!function_exists('hubunganjabatan')) {
    function hubunganjabatan($dinas, $tingkat)
    {

        $faktor = HubunganJabatan::with('data_parent.detailchild.datajabatan', 'datajabatan')->where([
            ['dinas_id', $dinas],
            ['tingkat', $tingkat]
        ])->get();
        // foreach ($faktor as $p) {
        //     $data[] = $p->faktorjabatan_id;
        // }
        return $faktor;
    }
};
if (!function_exists('childjabatan')) {
    function childjabatan($kodejabatan)
    {

        $faktor = HubunganJabatan::with('data_parent.detailchild.datajabatan', 'datajabatan')->where('kode_jabatan', $kodejabatan)->get();
        // foreach ($faktor as $p) {
        //     $data[] = $p->faktorjabatan_id;
        // }
        return $faktor;
    }
};
if (!function_exists('hubungandata')) {
    function hubungandata($kode)
    {
        $data = [];
        $array = explode(',', $kode);
        if (in_array('D0', $array)) {
            array_push($data, '- D0 = Memadukan data');
        }
        if (in_array('D1', $array)) {
            array_push($data, '- D1 = Mengkoordinasikan data');
        }
        if (in_array('D2', $array)) {
            array_push($data, '- D2 = Menganalisis data');
        }
        if (in_array('D3', $array)) {
            array_push($data, '- D3 = Menyusun data');
        }
        if (in_array('D4', $array)) {
            array_push($data, '- D4 = Menghitung data');
        }
        if (in_array('D5', $array)) {
            array_push($data, '- D5 = Membandingkan / Mencocokkan data');
        }
        if (in_array('D6', $array)) {
            array_push($data, '- D6 = Menyalin data');
        }
        // dd($data);
        return $data;
    }
};
if (!function_exists('hubunganbenda')) {
    function hubunganbenda($kode)
    {
        $data = [];
        $array = explode(',', $kode);
        if (in_array('B0', $array)) {
            array_push($data, '- B0 = Memasang mesin');
        }
        if (in_array('B1', $array)) {
            array_push($data, '- B1 = Mengerjakan persisi');
        }
        if (in_array('B2', $array)) {
            array_push($data, '- B2 = Menjalankan - mengontrol mesin');
        }
        if (in_array('B3', $array)) {
            array_push($data, '- B3 = Mengemudikan / menjalankan mesin');
        }
        if (in_array('B4', $array)) {
            array_push($data, '- B4 = Mengerjakan benda dengan tangan atau perkakas');
        }
        if (in_array('B5', $array)) {
            array_push($data, '- B5 = Melayani mesin');
        }
        if (in_array('B6', $array)) {
            array_push($data, '- B6 = Memasukkan, mengeluarkan barang ke/dari mesin');
        }
        if (in_array('B7', $array)) {
            array_push($data, '- B7 = Memegang');
        }
        // dd($data);
        return $data;
    }
};
if (!function_exists('hubunganorang')) {
    function hubunganorang($kode)
    {
        $data = [];
        $array = explode(',', $kode);
        if (in_array('O0', $array)) {
            array_push($data, '- O0 = Menasehati');
        }
        if (in_array('O1', $array)) {
            array_push($data, '- O1 = Berunding');
        }
        if (in_array('O2', $array)) {
            array_push($data, '- O2 = Mengajar');
        }
        if (in_array('O3', $array)) {
            array_push($data, '- O3 = Menyelia');
        }
        if (in_array('O4', $array)) {
            array_push($data, '- O4 = Menghibur');
        }
        if (in_array('O5', $array)) {
            array_push($data, '- O5 = Mempengaruhi');
        }
        if (in_array('O6', $array)) {
            array_push($data, '- O6 = Berbicara - memberi tanda');
        }
        if (in_array('O7', $array)) {
            array_push($data, '- O7 = Melayani orang');
        }
        if (in_array('O8', $array)) {
            array_push($data, '- O8 = Menerima instruksi');
        }
        // dd($data);
        return $data;
    }
};
if (!function_exists('bakat')) {
    function bakat($kode)
    {
        $data = [];
        $array = explode(',', $kode);
        if (in_array('G', $array)) {
            array_push($data, '- G = Intelegensia / Kemampuan belajar secara umum');
        }
        if (in_array('V', $array)) {
            array_push($data, '- V = Bakat Verbal / Kemampuan untuk memahami arti kata-kata dan penggunaannya secara tepat dan efektif');
        }
        if (in_array('N', $array)) {
            array_push($data, '- N = Bakat Numerik / Kemampuan untuk melakukan operasi arithmatik secara tepat dan akurat');
        }
        if (in_array('S', $array)) {
            array_push($data, '- S = Bakat Pandang Ruang / Kemampuan berpikir secara visual mengenai bentuk-bentuk geometris, untuk memahami gambar-gambar dari benda-benda tiga dimensi');
        }
        if (in_array('P', $array)) {
            array_push($data, '- P = Bakat Penerapan Bentuk / Kemampuan menyerap perincian-perincian yang berkaitan dalam objek atau dalam gambar atau dalam bahan grafik');
        }
        if (in_array('Q', $array)) {
            array_push($data, '- Q = Bakat Ketelitian / Kemampuan menyerap perincian yang berkaitan dalam bahan verbal atau dalam tabel');
        }
        if (in_array('K', $array)) {
            array_push($data, '- K = Koordinasi Motorik / Kemampuan untuk mengkoordinir mata dan tangan secara cepat dan cermat dalam membuat gerakan yang cepat');
        }
        if (in_array('F', $array)) {
            array_push($data, '- F = Kecekatan Jari / Kemampuan menggerakkan jari-jemari dengan mudah dan perlu keterampilan');
        }
        if (in_array('E', $array)) {
            array_push($data, '- E = Koordinasi Mata,Tangan, Kaki / Kemampuan menggerakkan tangan dan kaki secara koordinatif satu sama lain sesuai dengan rangsangan penglihatan');
        }
        if (in_array('C', $array)) {
            array_push($data, '- C = Kemampuan Membedakan Warna / Kemampuan memadukan atau membedakan berbagai warna yang asli, yang gemerlapan');
        }
        if (in_array('M', $array)) {
            array_push($data, '- M = Kecekatan Tangan / Kemampuan menggerakkan tangan dengan mudah dan penuh keterampilan');
        }
        // dd($data);
        return $data;
    }
};
if (!function_exists('temperamen')) {
    function temperamen($kode)
    {
        $data = [];
        $array = explode(',', $kode);
        if (in_array('D', $array)) {
            array_push($data, '- D = Kemampuan menyesuaikan diri menerima tanggung jawab untuk kegiatan memimpin, mengendalikan atau merencanakan');
        }
        if (in_array('F', $array)) {
            array_push($data, '- F = Kemampuan menyesuaikan diri dengan kegiatan yang mengandung penafsiran perasaan, gagasan atau fakta dari sudut pandangan pribadi');
        }
        if (in_array('I', $array)) {
            array_push($data, '- I = Kemampuan menyesuaikan diri untuk pekerjaan - pekerjaan mempengaruhi orang lain dalam pendapat, sikap atau pertimbangan mengenai gagasan');
        }
        if (in_array('J', $array)) {
            array_push($data, '- J = Kemampuan menyesuaikan diri pada kegiatan perbuatan kesimpulan penilaian atau pembuatan peraturan berdasarkan kriteria rangsangan indera atau atas dasar pertimbangan pribadi');
        }
        if (in_array('M', $array)) {
            array_push($data, '- M = Kemampuan menyesuaikan diri dengan kegiatan pengambilan peraturan, pembuatan, pertimbangan, atau pembuatan peraturan berdasarkan kriteria yang diukur atau yang dapat diuji');
        }
        if (in_array('P', $array)) {
            array_push($data, '- P = Kemampuan menyesuaikan diri dalam berhubungan dengan orang lain lebih dari hanya penerimaan dan pembuatan instruksi');
        }
        if (in_array('R', $array)) {
            array_push($data, '- R = Kemampuan menyesuaikan diri dalam kegiatan-kegiatan yang berulang, atau secara terus menerus melakukan kegiatan yang sama, sesuai dengan perangkat prosedur, urutan atau kecepatan yang tertentu');
        }
        if (in_array('S', $array)) {
            array_push($data, '- S = Kemampuan menyesuaikan diri untuk bekerja dengan ketegangan jiwa jika berhadapan dengan keadaan darurat, kritis, tidak biasa atau bahaya, atau bekerja dengan kecepatan kerja dan perhatian terus menerus merupakan keseluruhan atau sebagian aspek pekerjaan');
        }
        if (in_array('T', $array)) {
            array_push($data, '- T = Kemampuan menyesuaikan diri dengan situasi yang menghendaki pencapaian dengan tepat menurut perangkat batas, toleransi atau standar-standar tertentu');
        }
        if (in_array('V', $array)) {
            array_push($data, '- V = Kemampuan menyesuaikan diri untuk melaksanakan berbagai tugas, sering berganti dari tugas yang satu ke tugas yang lainnya yang "berbeda" sifatnya, tanpa kehilangan efisiensi atau ketenangan diri');
        }
        // dd($data);
        return $data;
    }
};
if (!function_exists('minat')) {
    function minat($kode)
    {
        $data = [];
        $array = explode(',', $kode);
        if (in_array('Investigatif', $array)) {
            array_push($data, '- Investigatif = Kemampuan analisis ilmiah / ilmiah');
        }
        if (in_array('Artistik', $array)) {
            array_push($data, '- Artistik = Melakukan pemikiran kreatif');
        }
        if (in_array('Sosial', $array)) {
            array_push($data, '- Sosial = Menjalin hubungan dengan orang lain, melakukan pelayanan kepada masyarakat');
        }
        if (in_array('Enterpreneurial', $array)) {
            array_push($data, '- Enterpreneurial = Pengambilan resiko, pengambilan keputusan dan negosiasi');
        }
        if (in_array('Konvensional', $array)) {
            array_push($data, '- Konvensional = Ketaatan terhadap prosedur / aturan');
        }
        // dd($data);
        return $data;
    }
};

if (!function_exists('biodataByJabatan')) {
    function biodataByJabatan($dinas_id)
    {
        $jabatan = hubunganjabatan::with('datajabatan', 'data_korelasi', 'data_biodata', 'data_kompetensi.data_kompetensi', 'standarkompetensi')
            ->filter(request(['search']))
            ->get();
        $biodata = BiodataJabatanModel::get();

        $biodataByJabatan = collect();

        foreach ($jabatan as $jabatanEntity) {
            foreach ($biodata as $databio) {
                if ($databio->kode_jabatan == $jabatanEntity->kode_jabatan && $jabatanEntity->dinas_id == $dinas_id) {
                    $biodataByJabatan->push([
                        'jabatan' => $jabatanEntity,
                        'biodata' => $databio,

                    ]);
                }
            }
        }

        // Get the current page from the url if it's not set default to 1
        $page = LengthAwarePaginator::resolveCurrentPage() ?: 1;

        // Create a new LengthAwarePaginator instance
        $items = $biodataByJabatan->forPage($page, 10); // Change 10 to the number of items you want per page
        $paginatedBiodataByJabatan = new LengthAwarePaginator($items, $biodataByJabatan->count(), 20, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return $paginatedBiodataByJabatan;
    }
};

if (!function_exists('biodataByDinas')) {
    function biodataByDinas($dinas_id)
    {
        $biodataJabatan = BiodataJabatanModel::whereHas('hubungan_jabatan_detail', function ($query) use ($dinas_id) {
            $query->where('dinas_id', $dinas_id);
        })->with(['hubungan_jabatan_detail.data_beban_kerja', 'hubungan_jabatan_detail.datajabatan', 'hubungan_jabatan_detail.get_parent.parent.datajabatan', 'hubungan_jabatan_detail.detaildinas'])->orderByRaw('CAST(REPLACE(kode_jabatan, " - ", ".") AS CHAR) ASC')->get();

        return $biodataJabatan;
    }
};

if (!function_exists('cekAksesUser')) {
    function cekAksesUser($dinas_id)
    {
        if (auth()->user()->role == 'user') {
            $user = HakAksesModel::where('user_id', auth()->user()->id)->first();

            // Cek apakah user memiliki dinas_id yang sesuai
            if (!$user || $dinas_id != $user->dinas_id) {
                abort(403, 'Anda Tidak Mempunyai Akses OPD Tersebut');
            }
        }
    }
}

