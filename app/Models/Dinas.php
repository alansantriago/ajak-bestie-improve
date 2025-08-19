<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dinas extends Model
{
    use HasFactory;
    protected $table = 'dinas';
    // protected $fillable = ['nama_dinas'];
    protected $guarded = NULL;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama_dinas', 'like', '%' . request('search') . '%');
        });
        // if (request('search')) {
        //     $query->where('nama_dinas', 'like', '%' . request('search') . '%');
        // }
    }
    public function getAll()
    {
        return DB::table('dinas');
    }
}
