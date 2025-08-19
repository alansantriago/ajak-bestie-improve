<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;

class PetaJabatanController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        if ($role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            $opd = Dinas::filter(request(['search']))->where('id', $dinas_id->dinas_id)->paginate(10)->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        }
        $data = [
            'opd' =>  $opd,
            'active' => 'peta',
        ];
        if ($role == 'bkd') {
            return view('admin.halaman_khusus_role.bkd.indexpeta', $data);
        } else {
            return view('admin.laporan.indexpeta', $data);
        }
    }
    public function detail($dinas_id)
    {

        $data = $this->generateData($dinas_id);
        // dd($data);
        return view('admin.laporan.detail1peta', $data);
    }
    public function generateData($dinas_id)
    {
        $namaopd = Dinas::where('id', $dinas_id)->first()->nama_dinas;

        // --- LANGKAH 1: Buat Peta Data Kelas Jabatan (Lookup Map) ---
        // Ambil semua ID jabatan yang ada di dinas ini
        $jabatanIds = HubunganJabatan::where('dinas_id', $dinas_id)->pluck('jabatan_id')->unique();
        
        // Ambil semua data jabatan beserta relasi faktornya dengan efisien
        $allJabatansInDinas = Jabatan::with('faktor.data_faktor')->whereIn('id', $jabatanIds)->get();

        $kelasLookup = [];
        foreach ($allJabatansInDinas as $jabatan) {
            $jumlahnilai = 0;
            if ($jabatan->faktor) {
                foreach ($jabatan->faktor as $faktor) {
                    if ($faktor->data_faktor && isset($faktor->data_faktor->nilai)) {
                        $jumlahnilai += $faktor->data_faktor->nilai;
                    }
                }
            }
            // --- PERBAIKAN: Panggil fungsi helper yang benar ('kelasjabatan1') ---
            // Pastikan fungsi ini menggunakan 'return', BUKAN 'echo'.
            $kelasLookup[$jabatan->nama_jabatan] = [
                'kelas_jabatan' => (int) preg_replace('/\D/', '', kelasjabatan1($jumlahnilai)),
                'total_nilai'   => $jumlahnilai,
            ];
        }

        // --- LANGKAH 2: Bangun Struktur Hierarki Awal (Dengan Eager Loading) ---
        $rootJabatans = HubunganJabatan::with('datajabatan') 
            ->whereDoesntHave('parents')
            ->where('dinas_id', $dinas_id)
            ->get();

        $jabatan_hierarchy = [];
        foreach ($rootJabatans as $rootJabatan) {
            // Cek jika datajabatan ada untuk menghindari error
            if (!$rootJabatan->datajabatan) {
                continue;
            }

            $tp_total = 0;
            if ($rootJabatan->total_beban_kerja != null) {
                $tp_total += $rootJabatan->total_beban_kerja;
            } else {
                foreach ($rootJabatan->data_beban_kerja as $beban) {
                    $tp_total += ($beban->penyelesaian / 1250) * $beban->jumlah_hasil;
                }
            }
            $peg_total_diff = round(
                $rootJabatan->pegawai - $tp_total,
                0,
                PHP_ROUND_HALF_EVEN,
            );
            if ($peg_total_diff == 0) {
                $peg_total_diff = abs($peg_total_diff);
            }

            $jabatan_hierarchy[$rootJabatan->datajabatan->nama_jabatan] = [
                'jenis_jabatan' => $rootJabatan->datajabatan->jenis_jabatan,
                'tree' => $rootJabatan->getTreeAttribute(),
                'pegawai' => $rootJabatan->pegawai,
                'tp_total' => round($tp_total, 0, PHP_ROUND_HALF_EVEN),
                'peg_total_diff' => $peg_total_diff,
            ];
        }

        // --- LANGKAH 3: Panggil fungsi rekursif untuk menyuntikkan data kelas jabatan ---
        $this->injectKelasJabatan($jabatan_hierarchy, $kelasLookup);

        return [
            'dinas_id' => $dinas_id,
            'namaopd' =>  $namaopd,
            'jabatan_hierarchy' => $jabatan_hierarchy,
            'active' => 'peta',
        ];
    }

    /**
     * Fungsi rekursif untuk menelusuri hierarki dan menambahkan data dari peta lookup.
     *
     * @param array &$hierarchy Array hierarki yang akan dimodifikasi.
     * @param array $lookup Peta data yang berisi kelas jabatan dan total nilai.
     * @return void
     */
    private function injectKelasJabatan(array &$hierarchy, array $lookup)
    {
        // Loop melalui setiap jabatan di level saat ini
        foreach ($hierarchy as $nama_jabatan => &$details) {
            // Cari data di peta lookup berdasarkan nama jabatan
            if (isset($lookup[$nama_jabatan])) {
                $details['kelas_jabatan'] = $lookup[$nama_jabatan]['kelas_jabatan'];
                $details['total_nilai'] = $lookup[$nama_jabatan]['total_nilai'];
            } else {
                // Jika tidak ditemukan, berikan nilai default
                $details['kelas_jabatan'] = 'N/A';
                $details['total_nilai'] = 0;
            }

            // Jika jabatan ini memiliki bawahan ('tree'), panggil fungsi ini lagi untuk level berikutnya
            if (!empty($details['tree']) && is_array($details['tree'])) {
                $this->injectKelasJabatan($details['tree'], $lookup);
            }
        }
    }

    public function peta($dinas_id)
    {
        $namaopd = Dinas::where('id', $dinas_id)->first()->nama_dinas;

        $data = $this->generateData($dinas_id);
        $view = view('admin.pdf.detailpeta', $data)->render();
        return $view;
    }
}
