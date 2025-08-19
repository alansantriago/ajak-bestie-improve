<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\KorelasiJabatanModel;
use Exception;
use Illuminate\Http\Request;

class KorelasiJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            $opd = Dinas::filter(request(['search']))->where('id', $dinas_id->dinas_id)->paginate(10)->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        }
        $data = [
            'opd' =>  $opd,
            'active' => 'analisiskorelasi',
        ];
        return view('admin.korelasi_jabatan.index', $data);
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
     * @param  \App\Models\KorelasiJabatanModel  $korelasiJabatanModel
     * @return \Illuminate\Http\Response
     */
    public function show(KorelasiJabatanModel $korelasiJabatanModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KorelasiJabatanModel  $korelasiJabatanModel
     * @return \Illuminate\Http\Response
     */
    public function edit(KorelasiJabatanModel $korelasiJabatanModel, $kode_jabatan)
    {
        $jabatan = HubunganJabatan::with('datajabatan')->where('kode_jabatan', $kode_jabatan)->first();
        $korelasi = KorelasiJabatanModel::where('kode_jabatan', $kode_jabatan)->get();
        // dd($jabatan);
        $data = [
            'kode_jabatan' => $kode_jabatan,
            'korelasi' => $korelasi,
            'jabatan' => $jabatan,
            'active' => 'analisiskorelasi',
        ];


        return view('admin.korelasi_jabatan.edit1', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KorelasiJabatanModel  $korelasiJabatanModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KorelasiJabatanModel $korelasiJabatanMode, $kode_jabatan)
    {
        // dd($kode_jabatan);
        $request->validate([
            'nama_jabatan' => 'required',
            'unit_kerja' => 'required',
            'deskripsi' => 'required',
        ]);
        try {
            KorelasiJabatanModel::where('kode_jabatan', $kode_jabatan)->delete();
            $i = 0;
            // for ($i = 0; $i <= 9; $i++) {
            foreach ($request->nama_jabatan as $index) {
                KorelasiJabatanModel::create([
                    'kode_jabatan' => $kode_jabatan,
                    'unit_kerja' => $request->unit_kerja[$i],
                    'deskripsi' => $request->deskripsi[$i],
                    'nama_jabatan' => $request->nama_jabatan[$i],
                ]);
                $i++;
            }
            return redirect()->back()->with('success', 'Korelasi Jabatan Berhasil Ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KorelasiJabatanModel  $korelasiJabatanModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(KorelasiJabatanModel $korelasiJabatanModel, $kode_jabatan)
    {
        try {
            KorelasiJabatanModel::where('kode_jabatan', $kode_jabatan)->delete();

            return redirect()->back()->with('Success', 'Data Korelasi Berhasil DIhapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }
}
