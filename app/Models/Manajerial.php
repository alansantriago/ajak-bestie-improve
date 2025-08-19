<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajerial extends Model
{
    use HasFactory;
    protected $table = 'data_kompetensi';
    // protected $fillable = ['nama_dinas'];
    protected $guarded = NULL;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_kompetensi', 'like', '%' . request('search') . '%');
        });
        // if (request('search')) {
        //     $query->where('nama_dinas', 'like', '%' . request('search') . '%');
        // }
    }
    public function kompetensi()
    {
        return $this->hasMany(Kompetensi::class, 'data_kompetensi_id', 'id');
    }
}
