<?php

namespace App\Http\Controllers;

use App\Models\BebanKerjaModel;
use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\HubunganJabatanVerifikasi;
use App\Models\Jabatan;
use App\Models\TugasPokok;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BebanKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')
                ->where('user_id', auth()->user()->id)
                ->first();
            $opd = Dinas::filter(request(['search']))
                ->where('id', $dinas_id->dinas_id)
                ->paginate(10)
                ->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))
                ->orderBy('id', 'ASC')
                ->paginate(10)
                ->withQueryString();
        }
        $data = [
            'opd' => $opd,
            'active' => 'analisisbebankerja',
        ];
        // dd($data);
        // return view('admin.manajerial.index', $data);
        return view('admin.bebankerja.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BebanKerjaModel  $bebanKerjaModel
     * @return \Illuminate\Http\Response
     */
    public function show(BebanKerjaModel $bebanKerjaModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BebanKerjaModel  $bebanKerjaModel
     * @return \Illuminate\Http\Response
     */
    public function edit(BebanKerjaModel $bebanKerjaModel, $kode_jabatan)
    {
        $jabatan = HubunganJabatan::with('datajabatan', 'data_tugas_pokok', 'detaildinas')->where('kode_jabatan', $kode_jabatan)->first();
        $beban_kerja = BebanKerjaModel::where('kode_jabatan', $kode_jabatan)->get();
        // dd($jabatan);
        $data = [
            'kode_jabatan' => $kode_jabatan,
            'beban_kerja' => $beban_kerja,
            'jabatan' => $jabatan,
            'active' => 'analisisbebankerja',
        ];

        return view('admin.bebankerja.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BebanKerjaModel  $bebanKerjaModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BebanKerjaModel $bebanKerjaModel, $kode_jabatan)
    {
        // dd($request->hasFile('file_input'));
        $jabatan = HubunganJabatan::select('kode_jabatan', 'jabatan_id', 'pegawai')->with('datajabatan')->where('kode_jabatan', $kode_jabatan)->first();

        $rules = [
            'pegawaiku' => 'required|numeric',
            'total' => 'required',
        ];

        // Inisialisasi aturan validasi
        $rules = [];

        if ($request->hasFile('file_input')) {
            $rules['file_input'] = 'required|mimes:pdf|max:2048';  // Maksimum 2MB
        }

        // Validasi untuk jumlah hasil dan penyelesaian
        if (!empty($request->penyelesaian) || !empty($request->jumlah)) {
            $rules['jumlah_hasil.*'] = 'required|numeric|min:0';  // Validasi jumlah hasil
            $rules['penyelesaian.*'] = 'required|numeric|min:0';  // Validasi penyelesaian
        }
        // dd($rules);
        // Validasi dengan pesan kustom
        $request->validate(
            $rules,
            [
                'file_input.required' => 'File PDF wajib diunggah.',
                'file_input.mimes' => 'File harus berformat PDF.',
                'file_input.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
                'jumlah_hasil.*.required' => 'Jumlah hasil wajib diisi.',
                'jumlah_hasil.*.numeric' => 'Jumlah hasil harus berupa angka.',
                'penyelesaian.*.required' => 'Penyelesaian wajib diisi.',
                'penyelesaian.*.numeric' => 'Penyelesaian harus berupa angka.',
                'pegawaiku.required' => 'Kolom pegawaiku wajib diisi.',
                'pegawaiku.numeric' => 'Pegawaiku harus berupa angka.',
                'total.required' => 'Total wajib diisi.',
            ]
        );
        try {
            if ($jabatan->datajabatan->jenis_jabatan == 'Fungsional') {

                $fileName = null;
                BebanKerjaModel::where('kode_jabatan', $kode_jabatan)->delete();
                if (($request->penyelesaian != null) || ($request->jumlah != null)) {
                    $i = 0;
                    // for ($i = 0; $i <= 9; $i++) {
                    foreach ($request->jumlah as $index) {
                        BebanKerjaModel::create([
                            'kode_jabatan' => $kode_jabatan,
                            'jumlah_hasil' => $request->jumlah[$i],
                            'penyelesaian' => $request->penyelesaian[$i],
                            'tingkat' => $i + 1,
                        ]);
                        $i++;
                    }
                } else {
                    // Ambil file dari request
                    if ($request->hasFile('file_input')) {
                        $file = $request->file('file_input');
                        // Cek apakah ada file sebelumnya di kolom file_beban_kerja
                        if ($jabatan->file_beban_kerja) {
                            $oldFilePath = 'public/beban_kerja_pdf/' . $jabatan->file_beban_kerja;

                            // Cek apakah file lama ada di storage
                            if (Storage::exists($oldFilePath)) {
                                // Hapus file lama
                                Storage::delete($oldFilePath);
                            }
                        }
                        // Tentukan nama file yang disimpan, misalnya dengan timestamp
                        $fileName = time() . '_' .  $jabatan->kode_jabatan . '.' . $file->getClientOriginalExtension();
                        // Simpan file di direktori public/storage/pdf
                        $path = $file->storeAs('public/beban_kerja_pdf', $fileName);
                    } else {
                        $fileName = $jabatan->file_beban_kerja;
                    }
                }
                HubunganJabatan::where('kode_jabatan', $kode_jabatan)->update(['pegawai' => $request->pegawaiku, 'file_beban_kerja' => $fileName, 'total_beban_kerja' => $request->total]);
                return redirect()->back()->withSuccess('Beban Kerja Berhasil Diperbaharui!');
            } else {

                $request->validate([
                    // 'kode_jabatan' => 'required',
                    'jumlah_hasil.*' => 'required|numeric|min:0',
                    // 'jumlah_hasil' => 'required|numeric|min:0',
                    'penyelesaian.*' => 'required|min:0',
                    // 'penyelesaian' => 'required|numeric|min:0',
                    // 'tingkat' => 'required|numeric|min:0',
                    'pegawaiku' => 'required|numeric',
                    'total' => 'required',
                ]);
                BebanKerjaModel::where('kode_jabatan', $kode_jabatan)->delete();
                $i = 0;
                // for ($i = 0; $i <= 9; $i++) {
                foreach ($request->jumlah as $index) {
                    BebanKerjaModel::create([
                        'kode_jabatan' => $kode_jabatan,
                        'jumlah_hasil' => $request->jumlah[$i],
                        'penyelesaian' => $request->penyelesaian[$i],
                        'tingkat' => $i + 1,
                    ]);
                    $i++;
                }
                HubunganJabatan::where('kode_jabatan', $kode_jabatan)->update(['pegawai' => $request->pegawaiku, 'file_beban_kerja' => null, 'total_beban_kerja' => $request->total]);
                return redirect()->back()->withSuccess('Beban Kerja Berhasil Diperbaharui!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BebanKerjaModel  $bebanKerjaModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BebanKerjaModel $bebanKerjaModel, $kode_jabatan)
    {
        try {
            BebanKerjaModel::where('kode_jabatan', $kode_jabatan)->delete();

            return redirect()->back()->with('Success', 'Data Beban Kerja Berhasil DIhapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }
}
