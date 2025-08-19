<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandarKompetensi extends Model
{
    use HasFactory;
    protected $table = 'standar_kompetensis';
    protected $guarded = NULL;
    protected $primarykey = "jabatan_id";
}
