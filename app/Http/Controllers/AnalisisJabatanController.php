<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Manajerial;
use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\HubunganJabatanParent;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AnalisisJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datajabatan(Request $request)
    {
        $value = $request->value;
        $data['jabatan'] = Jabatan::orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', $value)->get();
        return response()->json($data);
        // echo $output;
    }
    public function getcodeparent(Request $request)
    {
        $jumlah = 1;
        // $jumlah = HubunganJabatan::where([
        //     ['dinas_id', $request->id_opd],
        //     ['tingkat', $request->tingkat],
        // ])->count();

        do {
            $code = $request->iddinas . ' - ' . str_pad($jumlah, 2, '0', STR_PAD_LEFT);
            $cekkode = HubunganJabatan::where('kode_jabatan', $code)->count();
            if ($cekkode != 0) {
                $jumlah++;
            }
        } while ($cekkode != 0);
        return $code;
    }
    public function getcodechild(Request $request)
    {
        $jumlah = 1;

        do {
            $code = $request->kode_jabatan . '.' . str_pad($jumlah, 2, '0', STR_PAD_LEFT);
            $cekkode = HubunganJabatan::where('kode_jabatan', $code)->count();
            if ($cekkode != 0) {
                $jumlah++;
            }
        } while ($cekkode != 0);
        return $code;
    }
    public function index()
    {
        // $data = [
        //     'manajerial' =>  Manajerial::filter(request(['search']))->orderBy('nama_kompetensi', 'ASC')->orderBy('level', 'ASC')->paginate(25)->withQueryString(),
        //     'active' => 'jabatan',
        // ];
        if (auth()->user()->role == 'user') {
            $dinas_id = HakAksesModel::with('dinas')->where('user_id', auth()->user()->id)->first();
            $opd = Dinas::filter(request(['search']))->where('id', $dinas_id->dinas_id)->paginate(10)->withQueryString();
        } else {
            $opd = Dinas::filter(request(['search']))->orderBy('id', 'ASC')->paginate(10)->withQueryString();
        }
        $data = [
            'opd' =>  $opd,
            'struktural' => Jabatan::orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'struktural')->get(),
            'fungsional' => Jabatan::orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'fungsional')->get(),
            'pelaksana' => Jabatan::orderBy('nama_jabatan', 'ASC')->where('jenis_jabatan', 'pelaksana')->get(),
            'active' => 'analisisjabatan',
        ];
        // dd($data);
        // return view('admin.manajerial.index', $data);
        return view('admin.analisis_jabatan.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'active' => 'analisisjabatan',
        ];

        // dd($data);
        return view('admin.analisis_jabatan.tambah_halaman', $data);
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
        $validateData = $request->validate([
            'kode_jabatan' => 'required',
            'jenis_jabatan' => 'required',
            'jabatan' => 'required|numeric',
            'dinas_id' => 'required',
            'tingkat' => 'required',
        ]);
        $detailJabatan = Jabatan::Where('id', $request->jabatan)->first();
        try {
            if ($request->tingkat == 0) {
                HubunganJabatan::create([
                    'kode_jabatan' => $request->kode_jabatan,
                    'jabatan_id' => $request->jabatan,
                    'dinas_id' => $request->dinas_id,
                    'tingkat' => $request->tingkat,
                    'jpt_madya' => $detailJabatan->nama_unit,
                ]);
            } else {
                HubunganJabatan::create([
                    'kode_jabatan' => $request->kode_jabatan,
                    'jabatan_id' => $request->jabatan,
                    'dinas_id' => $request->dinas_id,
                    'tingkat' => $request->tingkat,
                    'jpt_madya' => 'Sekretariat Daerah',
                    'jpt_pratama' => $detailJabatan->nama_unit,
                ]);
            }
            return redirect()->back()->with('Success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }
    public function storechild(Request $request)
    {
        // dd($request);

        try {
            $validateData = $request->validate([
                'kode_jabatanparent' => 'required',
                'kode_jabatanchild' => 'required',
                'jabatanchild' => 'required',
                'jenis_jabatanchild' => 'required',
                'dinas_idchild' => 'required',
                'tingkatchild' => 'required',
            ]);
            $detailJabatan = Jabatan::Where('id', $request->jabatanchild)->first();
            $detailParent = HubunganJabatan::Where('kode_jabatan', $request->kode_jabatanparent)->first();
            if ($request->jenis_jabatanchild == "Struktural") {
                if ($detailParent->jpt_pratama == NULL) {
                    HubunganJabatan::create([
                        'kode_jabatan' => $request->kode_jabatanchild,
                        'jabatan_id' => $request->jabatanchild,
                        'dinas_id' => $request->dinas_idchild,
                        'tingkat' => ($request->tingkatchild),
                        'jpt_madya' => $detailParent->jpt_madya,
                        'jpt_pratama' => $detailJabatan->nama_unit,
                    ]);
                } else if ($detailParent->administrator == NULL) {
                    HubunganJabatan::create([
                        'kode_jabatan' => $request->kode_jabatanchild,
                        'jabatan_id' => $request->jabatanchild,
                        'dinas_id' => $request->dinas_idchild,
                        'tingkat' => ($request->tingkatchild),
                        'jpt_madya' => $detailParent->jpt_madya,
                        'jpt_pratama' => $detailParent->jpt_pratama,
                        'administrator' => $detailJabatan->nama_unit,
                    ]);
                } else if ($detailParent->pengawas == NULL) {
                    HubunganJabatan::create([
                        'kode_jabatan' => $request->kode_jabatanchild,
                        'jabatan_id' => $request->jabatanchild,
                        'dinas_id' => $request->dinas_idchild,
                        'tingkat' => ($request->tingkatchild),
                        'jpt_madya' => $detailParent->jpt_madya,
                        'jpt_pratama' => $detailParent->jpt_pratama,
                        'administrator' => $detailParent->administrator,
                        'pengawas' => $detailJabatan->nama_unit,
                    ]);
                }
            } else {
                HubunganJabatan::create([
                    'kode_jabatan' => $request->kode_jabatanchild,
                    'jabatan_id' => $request->jabatanchild,
                    'dinas_id' => $request->dinas_idchild,
                    'tingkat' => ($request->tingkatchild),
                    'jpt_madya' => $detailParent->jpt_madya,
                    'jpt_pratama' => $detailParent->jpt_pratama,
                    'administrator' => $detailParent->administrator,
                    'pengawas' => $detailParent->pengawas,
                ]);
            }
            HubunganJabatanParent::create([
                'parent_jabatan' => $request->kode_jabatanparent,
                'child_jabatan' => $request->kode_jabatanchild,
            ]);
            return redirect()->back()->with('Success', 'Data Berhasil Ditambahkan');
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



        try {

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
        function hapusFile($jabatan)
        {
            // Cek apakah ada file sebelumnya di kolom file_beban_kerja
            if ($jabatan->data_verifikasi && $jabatan->data_verifikasi->file_beban_kerja) {
                $oldFilePath = 'public/beban_kerja_pdf/' . $jabatan->data_verifikasi->file_beban_kerja;

                // Cek apakah file lama ada di storage
                if (Storage::exists($oldFilePath)) {
                    // Hapus file lama
                    Storage::delete($oldFilePath);
                }
            }
        }
        try {
            $ArrayCode = [];
            // $parent = HubunganJabatan::with('data_parent.detailchild.datajabatan')->where('kode_jabatan', $id)->first();
            $lvl2 = childjabatan($id);
            // array_push( $ArrayCode, $id );
            foreach ($lvl2 as $index) {
                array_push($ArrayCode, $index->kode_jabatan);
                hapusFile($index);
                if ($index->data_parent != NULL) {
                    foreach ($index->data_parent as $index) {
                        $lvl3 = childjabatan($index->child_jabatan);
                        foreach ($lvl3 as $index) {
                            array_push($ArrayCode, $index->kode_jabatan);
                            hapusFile($index);
                            if ($index->data_parent != NULL) {
                                foreach ($index->data_parent as $index) {
                                    $lvl4 = childjabatan($index->child_jabatan);
                                    foreach ($lvl4 as $index) {
                                        array_push($ArrayCode, $index->kode_jabatan);
                                        hapusFile($index);
                                        if ($index->data_parent != NULL) {
                                            foreach ($index->data_parent as $index) {
                                                $lvl5 = childjabatan($index->child_jabatan);
                                                foreach ($lvl5 as $index) {
                                                    array_push($ArrayCode, $index->kode_jabatan);
                                                    hapusFile($index);
                                                    if ($index->data_parent != NULL) {
                                                        foreach ($index->data_parent as $index) {
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            HubunganJabatan::with('data_parent.detailchild.datajabatan')->whereIn('kode_jabatan', $ArrayCode)->delete();
            return redirect()->back()->with('Success', 'Data Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal hapus data, Terjadi Kesalahan Sistem!');
        }
    }
}
