<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BebanKerjaModel extends Model
{
    use HasFactory;
    protected $table = 'beban_kerja';
    protected $guarded = NULL;
}
