<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    use HasFactory;
    protected $table = 'kompetensi';
    protected $guarded = NULL;
    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id');
    }
    public function data_kompetensi()
    {
        return $this->hasOne(Manajerial::class, 'id', 'data_kompetensi_id');
    }
}
