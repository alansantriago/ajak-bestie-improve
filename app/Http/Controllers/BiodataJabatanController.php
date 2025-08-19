<?php

namespace App\Http\Controllers;

use App\Models\BebanKerjaModel;
use App\Models\Dinas;
use App\Models\HakAksesModel;
use App\Models\HubunganJabatan;
use App\Models\BiodataJabatanModel;
use Exception;
use Illuminate\Http\Request;

class BiodataJabatanController extends Controller
{
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
            'active' => 'biodatajabatan',
        ];

        return view('admin.biodata_jabatan.index1', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kode_jabatan)
    {
        // $golongan = golongan_pns();


        $jabatan = HubunganJabatan::with('datajabatan', 'data_beban_kerja')->filter(request(['search']))->where('kode_jabatan', $kode_jabatan)->first();
        $data = [
            'kode_jabatan' => $kode_jabatan,
            'jabatan' => $jabatan,
            // 'golongan' => $golongan,
            'active' => 'biodatajabatan',
        ];
        //echo "ada";
        return view('admin.biodata_jabatan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kode_jabatan)
    {
        // Define an array with the fields you want to check
        $fieldsToCheck = ['nip', 'nama', 'tempat_lahir', 'tanggal_lahir', 'masa_kerja_jabatan_tahun', 'masa_kerja_jabatan_bulan', 'masa_kerja_keseluruhan_tahun', 'masa_kerja_keseluruhan_bulan', 'riwayat', 'tahun_diangkat', 'tahun_pensiun', 'pangkat', 'jenjang_pendidikan', 'jurusan'];


        try {
            $allFieldsAreNotNull = true;

            // Check each field in the request to make sure it is not NULL
            foreach ($fieldsToCheck as $field) {
                // dd($request);
                if (is_null($request->$field)) {
                    $allFieldsAreNotNull = false;
                    break; // Exit the loop if any field is NULL
                }
            }

            if ($allFieldsAreNotNull) {
                BiodataJabatanModel::create([
                    'kode_jabatan' => $kode_jabatan,
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'masa_kerja_jabatan_tahun' => $request->masa_kerja_jabatan_tahun,
                    'masa_kerja_jabatan_bulan' => $request->masa_kerja_jabatan_bulan,
                    'masa_kerja_keseluruhan_tahun' => $request->masa_kerja_keseluruhan_tahun,
                    'masa_kerja_keseluruhan_bulan' => $request->masa_kerja_keseluruhan_bulan,
                    'riwayat' => $request->riwayat,
                    'tahun_diangkat' => $request->tahun_diangkat,
                    'tahun_pensiun' => $request->tahun_pensiun,
                    'pangkat' => $request->pangkat,
                    'jenjang_pendidikan' => $request->jenjang_pendidikan,
                    'jurusan' => $request->jurusan,
                    'updated_at' => now(),

                ]);
            }

            return redirect()->back()->with('success', 'Tambahan Biodata Jabatan Berhasil Ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan Input, Perhatikan lebih detail lagi.')->withInput();
        }
    }


    public function show(BiodataJabatanModel $BiodataJabatanModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BiodataJabatanModel  $BiodataJabatanModel
     * @return \Illuminate\Http\Response
     */
    public function edit(BiodataJabatanModel $biodataJabatanModel, $kode_jabatan)
    {
        $jabatan = HubunganJabatan::with('datajabatan', 'data_beban_kerja')->filter(request(['search']))->where('kode_jabatan', $kode_jabatan)->first();
        $biodata = BiodataJabatanModel::where('kode_jabatan', $kode_jabatan)->get();

        $count = BebanKerjaModel::where('kode_jabatan', $kode_jabatan)->select('id')->get()->count();

        // if ($jabatan->pegawai == 0) {

        //     return redirect()->back()->with('Errors', 'Data Bazeting Kosong pada Jabatan ' . $jabatan->datajabatan->nama_jabatan . ', Silahkan isi Data Beban Kerja Terlebih Dahulu!');
        // } else

        if ($count == 0 && $jabatan->total_beban_kerja == NULL) {
            return redirect()->back()->with('Errors', 'Data Beban Kerja Jabatan ' . $jabatan->datajabatan->nama_jabatan . ' Kosong, Silahkan isi Data Beban Kerja Terlebih Dahulu!');
        } else {
            $data = [
                'kode_jabatan' => $kode_jabatan,
                'biodata' => $biodata,
                'jabatan' => $jabatan,
                'active' => 'biodatajabatan',
            ];
            //echo "ada";
            return view('admin.biodata_jabatan.edit', $data);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BiodataJabatanModel  $BiodataJabatanModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BiodataJabatanModel $BiodataJabatanModel, $kode_jabatan)
    {
        // Define an array with the fields you want to check
        $fieldsToCheck = ['nip', 'nama', 'tempat_lahir', 'tanggal_lahir', 'masa_kerja_jabatan_tahun', 'masa_kerja_jabatan_bulan', 'masa_kerja_keseluruhan_tahun', 'masa_kerja_keseluruhan_bulan', 'riwayat', 'tahun_diangkat', 'tahun_pensiun', 'pangkat', 'jenjang_pendidikan', 'jurusan'];


        try {
            BiodataJabatanModel::where('kode_jabatan', $kode_jabatan)->delete();
            $i = 0;
            // for ($i = 0; $i <= 9; $i++) {
            foreach ($request->nip as $index) {
                // Initialize a flag to true
                $allFieldsAreNotNull = true;

                // Check each field in the request to make sure it is not NULL
                foreach ($fieldsToCheck as $field) {
                    // dd($request);
                    if (is_null($request->$field[$i])) {
                        $allFieldsAreNotNull = false;
                        break; // Exit the loop if any field is NULL
                    }
                }

                if ($allFieldsAreNotNull) {
                    BiodataJabatanModel::create([
                        'kode_jabatan' => $kode_jabatan,
                        'nip' => $request->nip[$i],
                        'nama' => $request->nama[$i],
                        'tempat_lahir' => $request->tempat_lahir[$i],
                        'tanggal_lahir' => $request->tanggal_lahir[$i],
                        'masa_kerja_jabatan_tahun' => $request->masa_kerja_jabatan_tahun[$i],
                        'masa_kerja_jabatan_bulan' => $request->masa_kerja_jabatan_bulan[$i],
                        'masa_kerja_keseluruhan_tahun' => $request->masa_kerja_keseluruhan_tahun[$i],
                        'masa_kerja_keseluruhan_bulan' => $request->masa_kerja_keseluruhan_bulan[$i],
                        'riwayat' => $request->riwayat[$i],
                        'tahun_diangkat' => $request->tahun_diangkat[$i],
                        'tahun_pensiun' => $request->tahun_pensiun[$i],
                        'pangkat' => $request->pangkat[$i],
                        'jenjang_pendidikan' => $request->jenjang_pendidikan[$i],
                        'jurusan' => $request->jurusan[$i],
                        'updated_at' => now(),

                    ]);
                }
                $i++;
            }
            return redirect()->back()->with('success', 'Biodata Jabatan Berhasil Ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan Input');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BiodataJabatanModel  $BiodataJabatanModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BiodataJabatanModel $BiodataJabatanModel, $kode_jabatan)
    {

        try {
            BiodataJabatanModel::where('kode_jabatan', $kode_jabatan)->delete();

            return redirect()->back()->with('Success', 'Data Biodata Jabatan Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }

    public function destroy_id(BiodataJabatanModel $BiodataJabatanModel, $id)
    {

        try {
            BiodataJabatanModel::where('id', $id)->delete();

            return redirect()->back()->with('success', 'Biodata Jabatan Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terdapat kesalahan sistem');
        }
    }
}
