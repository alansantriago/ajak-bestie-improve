<?php

namespace App\Models;

// use App\Models\Faktor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    // protected $fillable = ['nama_dinas'];
    protected $guarded = NULL;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_jabatan', 'like', '%' . request('search') . '%');
        });
        // if (request('search')) {
        //     $query->where('nama_dinas', 'like', '%' . request('search') . '%');
        // }
    }
    public function faktor()
    {
        return $this->hasMany(Faktor::class, 'jabatan_id');
    }
    public function kompetensi()
    {
        return $this->hasMany(Kompetensi::class, 'jabatan_id');
    }
    public function bahan_kerja()
    {
        return $this->hasMany(BahanKerja::class, 'jabatan_id');
    }
    public function tugas_pokok()
    {
        return $this->hasMany(TugasPokok::class, 'jabatan_id');
    }
    public function perangkat_kerja()
    {
        return $this->hasMany(PerangkatKerja::class, 'jabatan_id');
    }
    public function lingkungan_kerja()
    {
        return $this->hasMany(LingkunganKerja::class, 'jabatan_id');
    }

    // public function data_faktor()
    // {
    //     return $this->belongsTo(FaktorJabatan::class, 'faktorjabatan_id');
    // }
    // public function childjabatan()
    // {
    //     return $this->hasMany(Jabatan::class, 'id', 'faktorjabatan_id');
    // }
}
