<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faktor extends Model
{
    use HasFactory;
    protected $table = 'faktor';
    protected $guarded = NULL;
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_faktor', 'like', '%' . request('search') . '%');
        });
        // if (request('search')) {
        //     $query->where('nama_dinas', 'like', '%' . request('search') . '%');
        // }
    }
    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id');
    }
    public function data_faktor()
    {
        return $this->hasOne(FaktorJabatan::class, 'id', 'faktorjabatan_id');
    }
}
