<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAkunModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = NULL;

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%');
        });
        // if (request('search')) {
        //     $query->where('nama_dinas', 'like', '%' . request('search') . '%');
        // }
    }
}
