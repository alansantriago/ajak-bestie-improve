<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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
        return view('admin.laporan.detail1peta', $data);
    }

    public function generateData($dinas_id)
    {
        $namaopd = Dinas::where('id', $dinas_id)->first()->nama_dinas;

        $jabatanIds = HubunganJabatan::where('dinas_id', $dinas_id)->pluck('jabatan_id')->unique();
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
            $kelasLookup[$jabatan->nama_jabatan] = [
                'kelas_jabatan' => (int) preg_replace('/\D/', '', kelasjabatan1($jumlahnilai)),
                'total_nilai'   => $jumlahnilai,
            ];
        }

        $rootJabatans = HubunganJabatan::with('datajabatan') 
            ->whereDoesntHave('parents')
            ->where('dinas_id', $dinas_id)
            ->get();

        $jabatan_hierarchy = [];
        foreach ($rootJabatans as $rootJabatan) {
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
            $peg_total_diff = round($rootJabatan->pegawai - $tp_total, 0, PHP_ROUND_HALF_EVEN);
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

        $this->injectKelasJabatan($jabatan_hierarchy, $kelasLookup);

        return [
            'dinas_id' => $dinas_id,
            'namaopd' =>  $namaopd,
            'jabatan_hierarchy' => $jabatan_hierarchy,
            'active' => 'peta',
        ];
    }

    private function injectKelasJabatan(array &$hierarchy, array $lookup)
    {
        foreach ($hierarchy as $nama_jabatan => &$details) {
            if (isset($lookup[$nama_jabatan])) {
                $details['kelas_jabatan'] = $lookup[$nama_jabatan]['kelas_jabatan'];
                $details['total_nilai'] = $lookup[$nama_jabatan]['total_nilai'];
            } else {
                $details['kelas_jabatan'] = 'N/A';
                $details['total_nilai'] = 0;
            }
            if (!empty($details['tree']) && is_array($details['tree'])) {
                $this->injectKelasJabatan($details['tree'], $lookup);
            }
        }
    }

    public function peta(Request $request, $dinas_id)
    {
        $data = $this->generateData($dinas_id);
        $data['orientasi'] = $request->query('orientasi', 'landscape');
        return view('admin.pdf.detailpeta', $data);
    }
    
    public function unduhPetaPdf(Request $request, $dinas_id)
    {
        $data = $this->generateData($dinas_id);
        $data['orientasi'] = $request->query('orientasi', 'landscape');

        $pdf = Pdf::loadView('admin.pdf.downloadpeta', $data); 
        $pdf->setPaper('a4', $data['orientasi']);
        $namaFile = 'peta-jabatan-' . Str::slug($data['namaopd']) . '-' . $data['orientasi'] . '.pdf';
        return $pdf->download($namaFile);
    }
}

