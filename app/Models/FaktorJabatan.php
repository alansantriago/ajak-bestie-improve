<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaktorJabatan extends Model
{
    use HasFactory;
    protected $table = 'data_faktor';
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
    public function faktors()
    {
        return $this->hasMany(Faktor::class, 'faktorjabatan_id', 'id');
    }
}
