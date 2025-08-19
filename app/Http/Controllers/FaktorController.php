<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FaktorJabatan;

use Illuminate\Http\Request;

class FaktorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'faktor' =>  FaktorJabatan::filter(request(['search']))->orderByRaw("jenis_jabatan ASC, nama_faktor ASC")->paginate(10)->withQueryString(),
            'active' => 'faktor',
        ];

        // dd($data);
        return view('admin.faktor.index', $data);
    }
    public function indexstruktural()
    {
        $data = [
            'faktor' =>  FaktorJabatan::where('jenis_jabatan', '6 Faktor')->orderBy('nama_faktor', 'ASC')->get(),
            'active' => 'faktor',
        ];

        // dd($data);
        return view('admin.faktor.index_struktural', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'active' => 'faktor',
        ];
        return view('admin.faktor.tambah_struktural', $data);
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
            'nama_faktor' => 'required',
            'nilai' => 'required|numeric|min:0',
            'indikator' => 'required',
            'tingkat' => 'required',
            'jenis_jabatan' => 'required'
        ]);
        $cekdata = FaktorJabatan::where([
            'nama_faktor' => $request->nama_faktor,
            'tingkat' => $request->tingkat,
            'jenis_jabatan' => $request->jenis_jabatan,
        ])->count();
        if ($cekdata > 0) {
            return back()->withInput()->with('failed', 'Data Faktor pada Jenis Faktor tersebut sudah ada. Jika ingin mengganti data silahkan ke bagian edit faktor');
        }
        // dd($validateData);
        FaktorJabatan::create($validateData);

        // dd($cek);
        return redirect()->back()->with('success', 'Data Berhasil Tambahkan');
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaktorJabatan  $faktorJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(FaktorJabatan $faktorJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaktorJabatan  $faktorJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(FaktorJabatan $faktorJabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FaktorJabatan  $faktorJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            // 'nama_faktor' => 'required',
            'nilai' => 'numeric|required',
            'indikator' => 'required',
            // 'id' => 'required|unique:dinas'
        ]);

        // if ($id != $request->id) {
        //     $validateData = $request->validate([
        //         // 'nama_dinas' => 'required',
        //         'id' => 'required|unique:dinas'
        //     ]);
        // }
        FaktorJabatan::where('id', $id)->update($validateData);

        return redirect()->back()->with('success', $request->nama_faktor . ' has been update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaktorJabatan  $faktorJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            FaktorJabatan::find($id)->delete();

            return redirect()->back()->withSuccess('Faktor Jabatan has been deleted!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to delete because data still used!');
        }
    }
}
