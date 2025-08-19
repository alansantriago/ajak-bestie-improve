<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Jabatan;
use App\Models\TugasPokok;
use App\Models\BahanKerja;
use App\Models\LingkunganKerja;
use App\Models\PerangkatKerja;
use App\Models\SyaratKerja;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($jenis_jabatan)
    {
        $data = [
            'jabatan' =>  Jabatan::filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->paginate(25)->withQueryString(),
            'active' => 'jabatan',
        ];

        // dd($data);
        return view('admin.jabatan.index', $data);
    }
    public function pelaksana()
    {
        $data = [
            'jabatan' =>  Jabatan::filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'pelaksana')->paginate(25)->withQueryString(),
            'active' => 'jabatan',
            'jenis_jabatan' => 'Pelaksana',
        ];

        // dd($data);
        return view('admin.jabatan.index', $data);
    }
    public function fungsional()
    {
        $data = [
            'jabatan' =>  Jabatan::filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'fungsional')->paginate(25)->withQueryString(),
            'active' => 'jabatan',
            'jenis_jabatan' => 'Fungsional',
        ];

        // dd($data);
        return view('admin.jabatan.index', $data);
    }
    public function struktural()
    {
        $data = [
            'jabatan' =>  Jabatan::filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'struktural')->paginate(25)->withQueryString(),
            'active' => 'jabatan',
            'jenis_jabatan' => 'Struktural',
        ];

        // dd($data);
        return view('admin.jabatan.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'active' => 'jabatan',
        ];

        // dd($data);
        return view('admin.jabatan.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validasi Jabatan
        $request->validate([
            'nama_jabatan' => 'required',
            'nama_unit' => 'required',
            'ikhtisar' => 'required',
            'pdd_formal' => 'required',
            'pdd_jurusan' => 'required',
            'pelatihan_struktural' => 'required',
            'pelatihan_fungsional' => 'required',
            'pelatihan_teknis' => 'required',
            'pengalaman_kerja' => 'required',
            'hasil_kerja_jabatan' => 'required',
            'tanggung_jawab' => 'required',
            'wewenang' => 'required',
            'prestasi_harapan' => 'required',
            'jenis_jabatan' => 'required',
        ]);
        // Validasi Tugas Pokok
        $request->validate([
            'uraian_tugas' => 'required',
            'hasil_kerja' => 'required',
            'uraian_tugas.*' => 'required',
            'hasil_kerja.*' => 'required',
        ]);
        // Validasi Bahan Kerja
        $request->validate([
            'bahan_kerja' => 'required',
            'penggunaan_bahan' => 'required',
            'bahan_kerja.*' => 'required',
            'penggunaan_bahan.*' => 'required',
        ]);
        // Validasi Perangkat Kerja
        $request->validate([
            'perangkat_kerja' => 'required',
            'penggunaan' => 'required',
            'perangkat_kerja.*' => 'required',
            'penggunaan.*' => 'required',
        ]);
        // Validasi Risiko Bahaya
        $request->validate([
            'fisik' => 'required',
            'mental' => 'required',
        ]);
        // Validasi Lingkungan Kerja
        $request->validate([
            'tempat_kerja' => 'required|numeric|min:0',
            'suhu' => 'required',
            'udara' => 'required',
            'keadaan_ruangan' => 'required',
            'letak' => 'required',
            'penerangan' => 'required',
            'suara' => 'required',
            'keadaan_tempat_kerja' => 'required',
            'getaran' => 'required',
        ]);
        // Validasi Syarat Kerja
        $request->validate([
            'keterampilan' => 'required',
            'bakat' => 'required|min:1',
            'temperamen' => 'required|min:1',
            'minat' => 'required|min:1',
            'upaya_fisik' => 'required|min:1',
            'jenis_kelamin' => 'required',
            'umur' => 'required',
            'tinggi' => 'required',
            'berat' => 'required',
            'postur' => 'required',
            'penampilan' => 'required',
            'hubungan_data' => 'required|min:1',
            'hubungan_orang' => 'required|min:1',
            'hubungan_benda' => 'required|min:1',
        ]);
        try {

            $id = Jabatan::create([
                'nama_jabatan' => $request->nama_jabatan,
                'nama_unit' => $request->nama_unit,
                'ikhtisar' => $request->ikhtisar,
                'pdd_formal' => $request->pdd_formal,
                'pdd_jurusan' => $request->pdd_jurusan,
                'pelatihan_struktural' => $request->pelatihan_struktural,
                'pelatihan_fungsional' => $request->pelatihan_fungsional,
                'pelatihan_teknis' => $request->pelatihan_teknis,
                'pengalaman_kerja' => $request->pengalaman_kerja,
                'hasil_kerja_jabatan' => $request->hasil_kerja_jabatan,
                'tanggung_jawab' => $request->tanggung_jawab,
                'wewenang' => $request->wewenang,
                'prestasi_harapan' => $request->prestasi_harapan,
                'jenis_jabatan' => $request->jenis_jabatan,
            ])->id;



            for ($i = 0; $i <= 9; $i++) {
                TugasPokok::create([
                    'jabatan_id' => $id,
                    'uraian_tugas' => $request->uraian_tugas[$i],
                    'hasil_kerja' => $request->hasil_kerja[$i],
                    'tingkat' => ($i + 1),
                ]);
            }

            for ($i = 0; $i <= 9; $i++) {
                BahanKerja::create([
                    'jabatan_id' => $id,
                    'bahan_kerja' => $request->bahan_kerja[$i],
                    'penggunaan_bahan' => $request->penggunaan_bahan[$i],
                    'tingkat' => ($i + 1),
                ]);
            }

            for ($i = 0; $i <= 9; $i++) {
                PerangkatKerja::create([
                    'jabatan_id' => $id,
                    'perangkat_kerja' => $request->perangkat_kerja[$i],
                    'penggunaan' => $request->penggunaan[$i],
                    'tingkat' => ($i + 1),
                ]);
            }

            LingkunganKerja::create([
                'jabatan_id' => $id,
                'tempat_kerja' => $request->tempat_kerja,
                'suhu' => $request->suhu,
                'udara' => $request->udara,
                'keadaan_ruangan' => $request->keadaan_ruangan,
                'letak' => $request->letak,
                'penerangan' => $request->penerangan,
                'suara' => $request->suara,
                'keadaan_tempat_kerja' => $request->keadaan_tempat_kerja,
                'getaran' => $request->getaran,
                'fisik' => $request->fisik,
                'mental' => $request->mental,
            ]);

            SyaratKerja::create([
                'jabatan_id' => $id,
                'keterampilan' => $request->keterampilan,
                'bakat' => implode(',', $request->bakat),
                'temperamen' => implode(',', $request->temperamen),
                'minat' => implode(',', $request->minat),
                'upaya_fisik' => implode(',', $request->upaya_fisik),
                'jenis_kelamin' => $request->jenis_kelamin,
                'umur' => $request->umur,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
                'postur' => $request->postur,
                'penampilan' => $request->penampilan,
                'hubungan_data' => implode(',', $request->hubungan_data),
                'hubungan_orang' => implode(',', $request->hubungan_orang),
                'hubungan_benda' => implode(',', $request->hubungan_benda),
            ]);
            return redirect()->back()->with('success', 'Jabatan Berhasil Ditambah!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to Insert Data!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $Jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $Jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $Jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $Jabatan)
    {
        $syarat_kerja = SyaratKerja::where('jabatan_id', $Jabatan->id)->first();
        if ($syarat_kerja != NULL) {
            $data = [
                'bahan_kerja' => BahanKerja::where('jabatan_id', $Jabatan->id)->get(),
                'tugas_pokok' => TugasPokok::where('jabatan_id', $Jabatan->id)->get(),
                'perangkat_kerja' => PerangkatKerja::where('jabatan_id', $Jabatan->id)->get(),
                'lingkungan_kerja' => LingkunganKerja::where('jabatan_id', $Jabatan->id)->first(),
                'bakat' => explode(',', $syarat_kerja->bakat),
                'temperamen' => explode(',', $syarat_kerja->temperamen),
                'minat' => explode(',', $syarat_kerja->minat),
                'upaya_fisik' => explode(',', $syarat_kerja->upaya_fisik),
                'hubungan_data' => explode(',', $syarat_kerja->hubungan_data),
                'hubungan_orang' => explode(',', $syarat_kerja->hubungan_orang),
                'hubungan_benda' => explode(',', $syarat_kerja->hubungan_benda),
                'syarat_kerja' => $syarat_kerja,
                'jabatan' => Jabatan::where('id', $Jabatan->id)->first(),
                'active' => 'jabatan',
            ];
        } else {
            $data = [
                'bahan_kerja' => BahanKerja::where('jabatan_id', $Jabatan->id)->get(),
                'tugas_pokok' => TugasPokok::where('jabatan_id', $Jabatan->id)->get(),
                'perangkat_kerja' => PerangkatKerja::where('jabatan_id', $Jabatan->id)->get(),
                'lingkungan_kerja' => LingkunganKerja::where('jabatan_id', $Jabatan->id)->first(),
                'syarat_kerja' => $syarat_kerja,
                'jabatan' => Jabatan::where('id', $Jabatan->id)->first(),
                'active' => 'jabatan',
            ];
        }

        // dd($data);
        return view('admin.jabatan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $Jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $Jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'nama_unit' => 'required',
            'ikhtisar' => 'required',
            'pdd_formal' => 'required',
            'pdd_jurusan' => 'required',
            'pelatihan_struktural' => 'required',
            'pelatihan_fungsional' => 'required',
            'pelatihan_teknis' => 'required',
            'pengalaman_kerja' => 'required',
            'hasil_kerja_jabatan' => 'required',
            'tanggung_jawab' => 'required',
            'wewenang' => 'required',
            'prestasi_harapan' => 'required',
            'jenis_jabatan' => 'required',
        ]);
        // Validasi Tugas Pokok
        $request->validate([
            'uraian_tugas' => 'required',
            'hasil_kerja' => 'required',
            'uraian_tugas.*' => 'required',
            'hasil_kerja.*' => 'required',
        ]);
        // Validasi Bahan Kerja
        $request->validate([
            'bahan_kerja' => 'required',
            'penggunaan_bahan' => 'required',
            'bahan_kerja.*' => 'required',
            'penggunaan_bahan.*' => 'required',
        ]);
        // Validasi Perangkat Kerja
        $request->validate([
            'perangkat_kerja' => 'required',
            'penggunaan' => 'required',
            'perangkat_kerja.*' => 'required',
            'penggunaan.*' => 'required',
        ]);
        // Validasi Risiko Bahaya
        $request->validate([
            'fisik' => 'required',
            'mental' => 'required',
        ]);
        // Validasi Lingkungan Kerja
        $request->validate([
            'tempat_kerja' => 'required|numeric|min:0',
            'suhu' => 'required',
            'udara' => 'required',
            'keadaan_ruangan' => 'required',
            'letak' => 'required',
            'penerangan' => 'required',
            'suara' => 'required',
            'keadaan_tempat_kerja' => 'required',
            'getaran' => 'required',
        ]);
        // Validasi Syarat Kerja
        $request->validate([
            'keterampilan' => 'required',
            'bakat' => 'required|min:1',
            'temperamen' => 'required|min:1',
            'minat' => 'required|min:1',
            'upaya_fisik' => 'required|min:1',
            'jenis_kelamin' => 'required',
            'umur' => 'required',
            'tinggi' => 'required',
            'berat' => 'required',
            'postur' => 'required',
            'penampilan' => 'required',
            'hubungan_data' => 'required|min:1',
            'hubungan_orang' => 'required|min:1',
            'hubungan_benda' => 'required|min:1',
        ]);
        try {
            $id = $Jabatan->id;
            Jabatan::where('id', $id)->update([
                'nama_jabatan' => $request->nama_jabatan,
                'nama_unit' => $request->nama_unit,
                'ikhtisar' => $request->ikhtisar,
                'pdd_formal' => $request->pdd_formal,
                'pdd_jurusan' => $request->pdd_jurusan,
                'pelatihan_struktural' => $request->pelatihan_struktural,
                'pelatihan_fungsional' => $request->pelatihan_fungsional,
                'pelatihan_teknis' => $request->pelatihan_teknis,
                'pengalaman_kerja' => $request->pengalaman_kerja,
                'hasil_kerja_jabatan' => $request->hasil_kerja_jabatan,
                'tanggung_jawab' => $request->tanggung_jawab,
                'wewenang' => $request->wewenang,
                'prestasi_harapan' => $request->prestasi_harapan,
                'jenis_jabatan' => $request->jenis_jabatan,
            ]);
            //Delete data

            BahanKerja::where('jabatan_id', $Jabatan->id)->delete();
            TugasPokok::where('jabatan_id', $Jabatan->id)->delete();
            PerangkatKerja::where('jabatan_id', $Jabatan->id)->delete();
            LingkunganKerja::where('jabatan_id', $Jabatan->id)->delete();
            SyaratKerja::where('jabatan_id', $Jabatan->id)->delete();

            $i = 0;
            foreach ($request->uraian_tugas as $index) {
                // for ($i = 0; $i <= 9; $i++) {
                TugasPokok::create([
                    'jabatan_id' => $id,
                    'uraian_tugas' => $request->uraian_tugas[$i],
                    'hasil_kerja' => $request->hasil_kerja[$i],
                    'tingkat' => ($i + 1),
                ]);
                $i++;
            }
            $i = 0;
            foreach ($request->bahan_kerja as $index) {
                // for ($i = 0; $i <= 9; $i++) {
                BahanKerja::create([
                    'jabatan_id' => $id,
                    'bahan_kerja' => $request->bahan_kerja[$i],
                    'penggunaan_bahan' => $request->penggunaan_bahan[$i],
                    'tingkat' => ($i + 1),
                ]);
                $i++;
            }
            $i = 0;
            foreach ($request->perangkat_kerja as $index) {
                // for ($i = 0; $i <= 9; $i++) {
                PerangkatKerja::create([
                    'jabatan_id' => $id,
                    'perangkat_kerja' => $request->perangkat_kerja[$i],
                    'penggunaan' => $request->penggunaan[$i],
                    'tingkat' => ($i + 1),
                ]);
                $i++;
            }

            LingkunganKerja::create([
                'jabatan_id' => $id,
                'tempat_kerja' => $request->tempat_kerja,
                'suhu' => $request->suhu,
                'udara' => $request->udara,
                'keadaan_ruangan' => $request->keadaan_ruangan,
                'letak' => $request->letak,
                'penerangan' => $request->penerangan,
                'suara' => $request->suara,
                'keadaan_tempat_kerja' => $request->keadaan_tempat_kerja,
                'getaran' => $request->getaran,
                'fisik' => $request->fisik,
                'mental' => $request->mental,
            ]);

            SyaratKerja::create([
                'jabatan_id' => $id,
                'keterampilan' => $request->keterampilan,
                'bakat' => implode(',', $request->bakat),
                'temperamen' => implode(',', $request->temperamen),
                'minat' => implode(',', $request->minat),
                'upaya_fisik' => implode(',', $request->upaya_fisik),
                'jenis_kelamin' => $request->jenis_kelamin,
                'umur' => $request->umur,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
                'postur' => $request->postur,
                'penampilan' => $request->penampilan,
                'hubungan_data' => implode(',', $request->hubungan_data),
                'hubungan_orang' => implode(',', $request->hubungan_orang),
                'hubungan_benda' => implode(',', $request->hubungan_benda),
            ]);
            return redirect()->back()->with('success', 'Data Jabatan Berhasil Diubah!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to Insert Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $Jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $Jabatan)
    {
        // dd($Jabatan->id);
        try {
            BahanKerja::where('jabatan_id', $Jabatan->id)->delete();
            TugasPokok::where('jabatan_id', $Jabatan->id)->delete();
            PerangkatKerja::where('jabatan_id', $Jabatan->id)->delete();
            LingkunganKerja::where('jabatan_id', $Jabatan->id)->delete();
            SyaratKerja::where('jabatan_id', $Jabatan->id)->delete();
            Jabatan::find($Jabatan->id)->delete();

            return redirect()->back()->with('success', 'Jabatan berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete OPD because data still used!');
        }
    }
}
