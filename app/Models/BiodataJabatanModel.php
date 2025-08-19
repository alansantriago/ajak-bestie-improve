<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataJabatanModel extends Model
{
    use HasFactory;
    protected $table = 'biodata_jabatan';
    protected $guarded = NULL;
    use HasFactory;

    public function hubungan_jabatan_detail()
    {
        return $this->belongsTo(HubunganJabatan::class, 'kode_jabatan', 'kode_jabatan');
    }
}

