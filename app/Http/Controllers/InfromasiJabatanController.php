<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Jabatan;
use App\Models\Faktor;
use Illuminate\Http\Request;

class InfromasiJabatanController extends Controller
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
            'active' => 'faktorjabatan',
        ];

        // dd($data);
        return view('admin.jabatan.index', $data);
    }
    public function pelaksana()
    {
        $data = [
            'jabatan' =>  Jabatan::with('faktor.data_faktor')->filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'pelaksana')->paginate(25)->withQueryString(),
            'active' => 'faktorjabatan',
        ];
        // dd($data['jabatan']);  
        // dd($data);
        return view('admin.informasi_faktor.struktural', $data);
    }
    public function fungsional()
    {
        $data = [
            'jabatan' =>  Jabatan::with('faktor.data_faktor')->filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'fungsional')->paginate(25)->withQueryString(),
            'active' => 'faktorjabatan',
        ];
        // dd($data['jabatan']);  
        // dd($data);
        return view('admin.informasi_faktor.struktural', $data);
    }
    public function struktural()
    {

        $data = [
            'jabatan' =>  Jabatan::with('faktor.data_faktor')->filter(request(['search']))->orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'struktural')->paginate(25)->withQueryString(),
            'active' => 'faktorjabatan',
        ];
        // dd($data['jabatan']);  
        // dd($data);
        return view('admin.informasi_faktor.struktural', $data); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'active' => 'faktorjabatan',
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
        $data_informasi_faktor = Faktor::where('jabatan_id', $id)->get();
        // dd($data_informasi_faktor->first());
        $data_faktor = [];
        if ($data_informasi_faktor->first() == NULL) {
            $data_faktor == NULL;
        } else {
            foreach ($data_informasi_faktor as $index) {
                $data_faktor[] = +$index->faktorjabatan_id;
            }
        }
        $informasi_faktor = Jabatan::with('faktor.data_faktor')->where('id', $id)->first();
        // dd($informasi_faktor);
        if ($informasi_faktor->faktor->first() != NULL) {
            $jenis_faktor = $informasi_faktor->faktor->first()->data_faktor->jenis_jabatan;
        } else {
            $jenis_faktor = NULL;
        }
        // $implode = implode(',', $data_faktor);
        // $explode = explode(',', $implode);
        // dd($explode);
        $data = [
            'jabatan' =>  Jabatan::where('id', $id)->first(),
            'informasi_faktor' =>  $informasi_faktor,
            'jenis_faktor' => $jenis_faktor,
            'data_informasi_faktor' =>  $data_faktor,
            'active' => 'faktorjabatan',
        ];
        // dd($data_faktor);
        // dd($data);
        return view('admin.informasi_faktor.edit_halaman', $data);
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
        try {
            Faktor::where('jabatan_id', $request->id)->delete();
            foreach ($request->faktor as $index) {
                Faktor::create([
                    'faktorjabatan_id' => $index,
                    'jabatan_id' => $request->id,
                ]);
            }
            return redirect()->back()->with('success', 'Data Faktor Jabatan Berhasil Diubah!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to Insert Data!');
        }
        // dd($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $Jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Jabatan $Jabatan)
    {
        // dd($request->id);
        try {
            Faktor::where('jabatan_id', $request->id)->delete();
            return redirect()->back()->with('success', 'Data Faktor Jabatan Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to Insert Data!');
        }
    }
}
