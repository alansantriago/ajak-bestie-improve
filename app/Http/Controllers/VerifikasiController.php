<?php

namespace App\Http\Controllers;

use App\Models\HubunganJabatanVerifikasi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function StatusVerifikasi($kode_jabatan, $kolom_verifikasi, $status_verifikasi)
    {
        HubunganJabatanVerifikasi::where('kode_jabatan', $kode_jabatan)->update([
            $kolom_verifikasi => $status_verifikasi,
        ]);

        return redirect()->back()->withSuccess('Berhasil memperbaharui status verifikasi!');
    }

    public function BukaStatusVerifikasi($kode_jabatan, $kolom_verifikasi)
    {
        HubunganJabatanVerifikasi::where('kode_jabatan', $kode_jabatan)->update([
            $kolom_verifikasi => null,
        ]);

        return redirect()->back()->withSuccess('Berhasil memperbaharui status verifikasi!');
    }
}
