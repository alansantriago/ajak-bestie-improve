<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Jabatan;
use App\Models\Kompetensi;
use App\Models\StandarKompetensi;
use Illuminate\Http\Request;

class KompetensiJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'jabatan' =>  Jabatan::filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->paginate(25)->withQueryString(),
            'active' => 'kompetensijabatan',
        ];

        // dd($data);
        return view('admin.jabatan.index', $data);
    }
    public function pelaksana()
    {
        $data = [
            'jabatan' =>  Jabatan::filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'pelaksana')->paginate(25)->withQueryString(),
            'active' => 'kompetensijabatan',
        ];

        // dd($data);
        return view('admin.standar_kompetensi.index', $data);
    }
    public function fungsional()
    {
        $data = [
            'jabatan' =>  Jabatan::filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'fungsional')->paginate(25)->withQueryString(),
            'active' => 'kompetensijabatan',
        ];

        // dd($data);
        return view('admin.standar_kompetensi.index', $data);
    }
    public function struktural()
    {
        $data = [
            'jabatan' =>  Jabatan::with('kompetensi.data_kompetensi')->filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'struktural')->paginate(25)->withQueryString(),
            'active' => 'kompetensijabatan',
        ];

        // dd($data['jabatan']);
        return view('admin.standar_kompetensi.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'active' => 'kompetensijabatan',
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
            'hasil_kerja' => 'required',
            'tanggung_jawab' => 'required',
            'wewenang' => 'required',
            'prestasi_harapan' => 'required',
            'jenis_jabatan' => 'required',
        ]);
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
            'hasil_kerja' => $request->hasil_kerja,
            'tanggung_jawab' => $request->tanggung_jawab,
            'wewenang' => $request->wewenang,
            'prestasi_harapan' => $request->prestasi_harapan,
            'jenis_jabatan' => $request->jenis_jabatan,
        ])->id;
        // Validasi Tugas Pokok
        $request->validate([
            'uraian_tugas' => 'required',
            'hasil_kerja' => 'required',
            'uraian_tugas.*' => 'required',
            'hasil_kerja.*' => 'required',
        ]); // Validasi Bahan Kerja
        $request->validate([
            'bahan' => 'required',
            'penggunaan_bahan' => 'required',
            'bahan.*' => 'required',
            'penggunaan_bahan.*' => 'required',
        ]); // Validasi Perangkat Kerja
        $request->validate([
            'bahan' => 'required',
            'penggunaan_bahan' => 'required',
            'bahan.*' => 'required',
            'penggunaan_bahan.*' => 'required',
        ]); // Validasi Perangkat Kerja
        $request->validate([
            'perangkat' => 'required',
            'penggunaan' => 'required',
            'perangkat.*' => 'required',
            'penggunaan.*' => 'required',
        ]); // Validasi Tanggung Jawab & Wewenang
        $request->validate([
            'tanggung_jawab' => 'required',
            'wewenang' => 'required',
        ]); // Validasi Tanggung Jawab & Wewenang
        $request->validate([
            'tempat_kerja' => 'required|numeric',
            'suhu' => 'required',
            'udara' => 'required',
            'keadaan_ruangan' => 'required',
            'letak' => 'required',
            'penerangan' => 'required',
            'suara' => 'required',
            'keadaan_tempat_kerja' => 'required',
            'getaran' => 'required',
        ]); // Validasi Risiko Bahaya
        $request->validate([
            'fisik' => 'required',
            'mental' => 'required',
        ]); // Validasi Syarat Kerja
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
            'hubungan_data' => 'required',
            'hubungan_orang' => 'required',
            'hubungan_benda' => 'required',
        ]); // Validasi Faktor Jabatan
        $request->validate([
            'faktor1' => 'required',
            'faktor2' => 'required',
            'faktor3' => 'required',
            'faktor4' => 'required',
            'faktor5' => 'required',
            'faktor6' => 'required',
            'faktor7' => 'required',
            'faktor8' => 'required',
            'faktor9' => 'required',
        ]); // Validasi Standar Kompetensi
        $request->validate([
            'kelompok_jabatan' => 'required',
            'urusan_pemerintahan' => 'required',
            'integritas' => 'required',
            'kerjasama' => 'required',
            'komunikasi' => 'required',
            'orientasi' => 'required',
            'pelayanan_publik' => 'required',
            'pengembangan_diri' => 'required',
            'mengelola_perubahan' => 'required',
            'pengambilan_keputusan' => 'required',
            'perekat_bangsa' => 'required',
            'indikator_kinerja' => 'required',
            'pangkat' => 'required',
        ]);
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
    public function edit(Jabatan $Jabatan, $id)
    {
        $jabatan = Jabatan::where('id', $id)->first();
        $data_informasi_kompetensi = Kompetensi::where('jabatan_id', $id)->get();
        // dd($data_informasi_faktor->first());
        $data_kompetensi = [];
        if ($data_informasi_kompetensi->first() == NULL) {
            $data_kompetensi == NULL;
        } else {
            foreach ($data_informasi_kompetensi as $index) {
                $data_kompetensi[] = +$index->data_kompetensi_id;
            }
        }
        $data = [
            'jabatan' => $jabatan,
            'standar_kompetensi' => StandarKompetensi::where('jabatan_id', $id)->first(),
            'kompetensi' => $data_kompetensi,
            'active' => 'kompetensijabatan',
        ];
        return view('admin.standar_kompetensi.edit_halaman', $data);
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
        // dd($request->pangkat);
        try {

            StandarKompetensi::where('jabatan_id', $request->id)->delete();
            Kompetensi::where('jabatan_id', $request->id)->delete();
            foreach ($request->kompetensi as $index) {
                Kompetensi::create([
                    'data_kompetensi_id' => $index,
                    'jabatan_id' => $request->id,
                ]);
            }
            StandarKompetensi::create([
                'pangkat' => $request->pangkat,
                'kelompok_jabatan' => $request->kelompok_jabatan,
                'urusan_pemerintahan' => $request->urusan_pemerintahan,
                'indikator_kinerja' => $request->indikator_kinerja,
                'jabatan_id' => $request->id,
            ]);
            return redirect()->back()->with('success', 'Data Kompetensi Jabatan Berhasil Diubah!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to Updated Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $Jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $Jabatan, $id)
    {
        try {
            Kompetensi::where('jabatan_id', $id)->delete();
            StandarKompetensi::where('jabatan_id', $id)->delete();
            return redirect()->back()->with('success', 'Data Kompetensi Jabatan Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to Deleted Data!');
        }
    }
}
