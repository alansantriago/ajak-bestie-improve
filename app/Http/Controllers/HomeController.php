<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\Jabatan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'aktif']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function pimpinan_indexrekapabk()
    {
            $jabatan = HubunganJabatan::with('datajabatan', 'data_faktor.data_faktor', 'data_kompetensi.data_kompetensi', 'standarkompetensi', 'data_beban_kerja', 'detaildinas')->orderBy('dinas_id', 'ASC')->orderBy('kode_jabatan', 'ASC')->filter(request(['search']))->paginate(20)->withQueryString();


        // dd($jabatan->first());
        return view('admin.halaman_khusus_role.pimpinan.indexrekap', [
            'jabatan' => $jabatan,
            'active' => 'home',
        ]);
    }
    public function bkd_indexrekapabk()
    {
            $jabatan = HubunganJabatan::with('datajabatan', 'data_faktor.data_faktor', 'data_kompetensi.data_kompetensi', 'standarkompetensi', 'data_beban_kerja', 'detaildinas')->orderBy('dinas_id', 'ASC')->orderBy('kode_jabatan', 'ASC')->filter(request(['search']))->paginate(20)->withQueryString();


        // dd($jabatan->first());
        return view('admin.halaman_khusus_role.bkd.indexrekap', [
            'jabatan' => $jabatan,
            'active' => 'laporan',
        ]);
    }

    public function bkd_informasi_jabatan()
    {
        $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        $data = [
            'opd' =>  $opd,
            'active' => 'informasijabatan',
        ];
        return view('admin.halaman_khusus_role.bkd.indexjabatan', $data);
    }

    public function index()
    {
        if (auth()->user()->role == 'user') {
            $aksesdinas = HakAksesModel::where('user_id', auth()->user()->id)->first();
            $total = HubunganJabatan::with('datajabatan')->where('dinas_id', $aksesdinas->dinas_id)->count();
            $struktural = HubunganJabatan::with('datajabatan')->where('dinas_id', $aksesdinas->dinas_id)->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'struktural');
            })->count();
            $fungsional = HubunganJabatan::with('datajabatan')->where('dinas_id', $aksesdinas->dinas_id)->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'fungsional');
            })->count();
            $pelaksana = HubunganJabatan::with('datajabatan')->where('dinas_id', $aksesdinas->dinas_id)->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'pelaksana');
            })->count();
            $bebankerja = HubunganJabatan::with('data_beban_kerja', 'detaildinas')->where('dinas_id', $aksesdinas->dinas_id)->doesntHave('data_beban_kerja')->limit(10)->get();
            $data = [
                'active' => 'home',
                'total' => $total,
                'struktural' => $struktural,
                'fungsional' => $fungsional,
                'pelaksana' => $pelaksana,
                'bebankerja' => $bebankerja,
            ];
        } else if (auth()->user()->role == 'pimpinan') {
            return redirect()->to(route('pimpinan.rekapitulasi'));
        } else if (auth()->user()->role == 'bkd') {
            $total = HubunganJabatan::with('datajabatan')->count();
            $struktural = HubunganJabatan::with('datajabatan')->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'struktural');
            })->count();
            $fungsional = HubunganJabatan::with('datajabatan')->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'fungsional');
            })->count();
            $pelaksana = HubunganJabatan::with('datajabatan')->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'pelaksana');
            })->count();
            return view('dashboard_bkd', [

                'active' => 'home',
                'total' => $total,
                'struktural' => $struktural,
                'fungsional' => $fungsional,
                'pelaksana' => $pelaksana,
            ]);
        } else {
            $total = HubunganJabatan::with('datajabatan')->count();
            $struktural = HubunganJabatan::with('datajabatan')->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'struktural');
            })->count();
            $fungsional = HubunganJabatan::with('datajabatan')->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'fungsional');
            })->count();
            $pelaksana = HubunganJabatan::with('datajabatan')->whereHas('datajabatan', function ($query) {
                return $query->where('jenis_jabatan',  'pelaksana');
            })->count();

            $bebankerja = HubunganJabatan::with('datajabatan', 'data_beban_kerja', 'detaildinas')->doesntHave('data_beban_kerja')->limit(10)->get();
            $jabatan = Jabatan::with('bahan_kerja', 'tugas_pokok', 'perangkat_kerja', 'lingkungan_kerja')->ordoesntHave('bahan_kerja')->ordoesntHave('tugas_pokok')->ordoesntHave('perangkat_kerja')->ordoesntHave('lingkungan_kerja')->limit(10)->get();
            $data = [
                'active' => 'home',
                'total' => $total,
                'struktural' => $struktural,
                'fungsional' => $fungsional,
                'pelaksana' => $pelaksana,
                'bebankerja' => $bebankerja,
                'jabatan' => $jabatan,
            ];
        }

        // dd($jabatan);

        return view('dashboard', $data);
    }
}
