<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Manajerial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManajerialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'manajerial' =>  Manajerial::filter(request(['search']))->orderBy('nama_kompetensi', 'ASC')->orderBy('level', 'ASC')->paginate(10)->withQueryString(),
            'active' => 'kompetensi',
        ];

        // dd($data);
        return view('admin.manajerial.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = [
        //     'active' => 'jabatan',
        // ];

        // // dd($data);
        // return view('admin.jabatan.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_kompetensi' => 'required',
            'level' => 'required|numeric',
            'deskripsi' => 'required',
            'indikator' => 'required',
        ]);
        $cekdata = Manajerial::where([
            'nama_kompetensi' => $request->nama_kompetensi,
            'level' => $request->level,
        ])->count();
        if ($cekdata > 0) {
            return back()->withInput()->with('failed', 'Data pada Kompetensi tersebut sudah ada.');
        }
        try {
            Manajerial::create([
                'nama_kompetensi' => $request->nama_kompetensi,
                'level' => $request->level,
                'deskripsi' => $request->deskripsi,
                'indikator' => $request->indikator,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Kompetensi Manajerial has been created!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manajerial  $Manajerial
     * @return \Illuminate\Http\Response
     */
    public function show(Manajerial $Manajerial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manajerial  $Manajerial
     * @return \Illuminate\Http\Response
     */
    public function edit(Manajerial $Manajerial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manajerial  $Manajerial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manajerial $Manajerial)
    {

        $dataawal = Manajerial::where([
            'id' => $request->id,
        ])->get()->first();
        // dd($request);
        $validateData = $request->validate([
            'id' => 'required|numeric',
            'nama_kompetensi' => 'required',
            'level' => 'required|numeric',
            'deskripsi' => 'required',
            'indikator' => 'required',
        ]);
        if (($request->level != $dataawal->level) || ($request->nama_kompetensi != $dataawal->nama_kompetensi)) {

            $cekdata = Manajerial::where([
                'nama_kompetensi' => $request->nama_kompetensi,
                'level' => $request->level,
            ])->count();
            if ($cekdata > 0) {
                return back()->withInput()->with('failed', 'Data pada Kompetensi tersebut sudah ada. Jika ingin mengedit jangan ganti nama dan level atau Silahkan tambah data baru');
            }
        }
        try {
            Manajerial::where('id', $request->id)->update([
                'deskripsi' => $request->deskripsi,
                'indikator' => $request->indikator,
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Kompetensi Manajerial has been updated!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manajerial  $Manajerial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Manajerial::Where('id', $id)->delete();
            return redirect()->back()->withSuccess('Kompetensi has been deleted!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to delete Kompetensi because data still used!');
        }
    }
}
