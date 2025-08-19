<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\KompetensiTeknisModel;
use Exception;
use Illuminate\Http\Request;

class KompetensiTeknisController extends Controller
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
            'active' => 'analisisteknis',
        ];
        return view('admin.kompetensi_teknis.index', $data);
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
     * @param  \App\Models\KompetensiTeknisModel  $kompetensiTeknisModel
     * @return \Illuminate\Http\Response
     */
    public function show(KompetensiTeknisModel $kompetensiTeknisModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KompetensiTeknisModel  $kompetensiTeknisModel
     * @return \Illuminate\Http\Response
     */
    public function edit(KompetensiTeknisModel $kompetensiTeknisModel, $kode_jabatan)
    {
        // dd($kode_jabatan);
        $jabatan = HubunganJabatan::with('datajabatan')->where('kode_jabatan', $kode_jabatan)->first();
        $teknis = KompetensiTeknisModel::where('kode_jabatan', $kode_jabatan)->get();
        // dd($jabatan);
        $data = [
            'kode_jabatan' => $kode_jabatan,
            'teknis' => $teknis,
            'jabatan' => $jabatan,
            'active' => 'analisisteknis',
        ];


        return view('admin.kompetensi_teknis.edit1', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KompetensiTeknisModel  $kompetensiTeknisModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KompetensiTeknisModel $kompetensiTeknisModel, $kode_jabatan)
    {
        // dd($request);
        $request->validate([
            'nama_kompetensi' => 'required',
            'level' => 'required',
            'deskripsi' => 'required',
            'indikator' => 'required',
        ]);
        try {
            KompetensiTeknisModel::where('kode_jabatan', $kode_jabatan)->delete();
            $i = 0;
            // for ($i = 0; $i <= 9; $i++) {
            foreach ($request->nama_kompetensi as $index) {
                KompetensiTeknisModel::create([
                    'kode_jabatan' => $kode_jabatan,
                    'nama_kompetensi' => $request->nama_kompetensi[$i],
                    'deskripsi' => $request->deskripsi[$i],
                    'level' => $request->level[$i],
                    'indikator' => $request->indikator[$i],
                ]);
                $i++;
            }
            return redirect()->back()->with('success', 'Kompetensi Teknis Berhasil Ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KompetensiTeknisModel  $kompetensiTeknisModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(KompetensiTeknisModel $kompetensiTeknisModel, $kode_jabatan)
    {
        try {
            KompetensiTeknisModel::where('kode_jabatan', $kode_jabatan)->delete();

            return redirect()->back()->with('Success', 'Data Kompetensi Teknis Berhasil DIhapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }
}
