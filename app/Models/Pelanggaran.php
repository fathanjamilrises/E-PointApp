<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    protected $fillable = [
        'jenis',
        'konsekuensi',
        'poin',
    ];
}
