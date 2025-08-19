<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganJabatan extends Model
{
    use HasFactory;

    protected $table = 'hubungan_jabatan';
    // protected $fillable = ['nama_dinas'];
    protected $guarded = NULL;
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('kode_jabatan', 'like', '%' . request('search') . '%')->orwhereHas('datajabatan', function ($query) {
                return $query->where('nama_jabatan',  'like', '%' . request('search') . '%');
            })->orwhereHas('standarkompetensi', function ($query) {
                return $query->where('kelompok_jabatan',  'like', '%' . request('search') . '%');
            });
        });
    }
    public function get_parent()
    {
        return $this->hasOne(HubunganJabatanParent::class, 'child_jabatan', 'kode_jabatan');
    }
    public function detaildinas()
    {
        return $this->hasOne(Dinas::class, 'id', 'dinas_id');
    }
    public function datajabatan()
    {
        return $this->hasOne(Jabatan::class, 'id', 'jabatan_id');
    }
    public function datafaktor()
    {
        return $this->hasOne(Jabatan::class, 'id', 'jabatan_id');
    }
    public function data_parent()
    {
        return $this->hasMany(HubunganJabatanParent::class, 'parent_jabatan', 'kode_jabatan');
    }
    public function data_tugas_pokok()
    {
        return $this->hasMany(TugasPokok::class, 'jabatan_id', 'jabatan_id');
    }
    public function data_bahan_kerja()
    {
        return $this->hasMany(BahanKerja::class, 'jabatan_id', 'jabatan_id');
    }
    public function data_perangkat_kerja()
    {
        return $this->hasMany(PerangkatKerja::class, 'jabatan_id', 'jabatan_id');
    }
    public function data_beban_kerja()
    {
        return $this->hasMany(BebanKerjaModel::class, 'kode_jabatan', 'kode_jabatan');
    }
    public function data_biodata()
    {
        return $this->hasMany(BiodataJabatanModel::class, 'kode_jabatan', 'kode_jabatan');
    }
    public function data_biodata_first()
    {
        return $this->hasOne(BiodataJabatanModel::class, 'kode_jabatan', 'kode_jabatan');
    }
    public function data_korelasi()
    {
        return $this->hasMany(KorelasiJabatanModel::class, 'kode_jabatan', 'kode_jabatan');
    }
    public function data_lingkungan()
    {
        return $this->hasOne(LingkunganKerja::class, 'jabatan_id', 'jabatan_id');
    }
    public function data_syarat()
    {
        return $this->hasOne(SyaratKerja::class, 'jabatan_id', 'jabatan_id');
    }
    public function data_faktor()
    {
        return $this->hasMany(Faktor::class, 'jabatan_id', 'jabatan_id');
    }
    public function data_kompetensi()
    {
        return $this->hasMany(Kompetensi::class, 'jabatan_id', 'jabatan_id');
    }
    public function kompetensi_teknis()
    {
        return $this->hasMany(KompetensiTeknisModel::class, 'kode_jabatan', 'kode_jabatan');
    }
    public function standarkompetensi()
    {
        return $this->hasOne(StandarKompetensi::class, 'jabatan_id', 'jabatan_id');
    }
    // public function data_child()
    // {
    //     return $this->hasOne(Jabatan::class, 'id', 'jabatan_id');
    // }

    public function children()
    {
        return $this->hasMany(HubunganJabatanParent::class, 'parent_jabatan', 'kode_jabatan')->with('child');
    }

    public function parents()
    {
        return $this->hasMany(HubunganJabatanParent::class, 'child_jabatan', 'kode_jabatan')->with('parent');
    }

    public function getTreeAttribute()
    {
        $children = $this->children->map(function ($childJabatanParent) {
            return $childJabatanParent->child;
        });

        $tree = [];

        foreach ($children as $childJabatan) { // <-- Variabel yang benar adalah $childJabatan
            if ($childJabatan->datajabatan !== null) {
                $tp_total = 0;
                if ($childJabatan->total_beban_kerja != null) {
                    $tp_total += $childJabatan->total_beban_kerja;
                } else {
                    foreach ($childJabatan->data_beban_kerja as $beban) {
                        $tp_total += ($beban->penyelesaian / 1250) * $beban->jumlah_hasil;
                    }
                }
                $peg_total_diff = round(
                    $childJabatan->pegawai - $tp_total,
                    0,
                    PHP_ROUND_HALF_EVEN,
                );
                if ($peg_total_diff == 0) {
                    $peg_total_diff = abs($peg_total_diff);
                }

                // KUNCI PERBAIKAN: Ganti semua variabel "$child" menjadi "$childJabatan"
                $tree[$childJabatan->datajabatan->nama_jabatan] = [
                    'jenis_jabatan' => $childJabatan->datajabatan->jenis_jabatan,
                    'tree' => $childJabatan->getTreeAttribute(),
                    'pegawai' => $childJabatan->pegawai,
                    'tp_total' => round($tp_total, 0, PHP_ROUND_HALF_EVEN),
                    'peg_total_diff' => $peg_total_diff
                ];
            }
        }

        return $tree;
    }


    public function getTotalAttribute()
    {
        return $this->data_faktor->sum('data_faktor.nilai');
    }

    public function getTpTotalAttribute()
    {
        return $this->data_beban_kerja->sum(function ($beban) {
            return ($beban->penyelesaian / 1250) * $beban->jumlah_hasil;
        });
    }

    public function getKelompokJabatanAttribute()
    {
        return str_replace("Jabatan ", '', $this->standarkompetensi->kelompok_jabatan ?? '');
    }
}
