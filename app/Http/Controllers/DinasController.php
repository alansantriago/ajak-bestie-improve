<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Dinas;
use Illuminate\Http\Request;
use Exception;

class DinasController extends Controller
{
    public function changeStatus(Request $request)
    {
        try {
            $user = Dinas::find($request->id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->status = $request->status;
            $user->save();

            return response()->json(['success' => 'Status Changed Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to change status: ' . $e->getMessage()], 500);
        }
    }

    public function changeAllStatus()
    {
        try {
            // Menghitung jumlah akun yang aktif
            $userAktif = Dinas::where('status', 'buka')->count();

            // Jika tidak ada akun yang aktif, aktifkan semua akun
            if ($userAktif == 0) {
                Dinas::query()->update(['status' => 'buka']);
                return redirect()->back()->with('success', 'Berhasil Mengaktifkan seluruh OPD');
            } else {
                // Menonaktifkan semua akun yang aktif
                Dinas::query()->update(['status' => 'kunci']);
                return redirect()->back()->with('success', 'Berhasil menutup seluruh OPD');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to change status: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $opd = DB::table('dinas');
        // // $opd = Dinas::get();
        // if (request('search')) {
        //     $opd->where('nama', 'like', '%' . request('search') . '%');
        // }
        $statusAktif = Dinas::where('status', 'buka')->count();
        $data = [
            'opd' =>  Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString(),
            'active' => 'opd',
            'statusAktif' => $statusAktif,
        ];

        // dd($data);
        return view('admin.opd.index', $data);
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

        $validateData = $request->validate([
            'nama_dinas' => 'required|unique:dinas'
        ]);
        // dd($validateData);
        Dinas::create($validateData);

        return redirect()->back()->with('success', 'New Organisasi Perangkat Daerah has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama_dinas' => 'required',
            // 'id' => 'required|unique:dinas'
        ]);
        if ($id != $request->id) {
            $validateData = $request->validate([
                // 'nama_dinas' => 'required',
                'id' => 'required|unique:dinas'
            ]);
        }
        Dinas::where('id', $id)->update($validateData);

        return redirect()->back()->with('success', 'New Organisasi Perangkat Daerah has been Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Dinas::find($id)->delete();

            return redirect()->back()->withSuccess('Organisasi Perangkat Daerah has been deleted!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete OPD because data still used!');
        }
    }
}
