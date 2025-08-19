<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Dinas;

class HakAksesModel extends Model
{
    use HasFactory;
    protected $table = 'hak_akses_user';
    protected $guarded = NULL;
    protected $primaryKey = 'user_id';
    public function dinas()
    {
        return $this->belongsTo(Dinas::class, 'dinas_id', 'id');
    }
}
