<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPinjaman extends Model
{
    use HasFactory;

    protected $table = 'v_hitung_pinjaman';

    protected $casts = [
        'tgl_pinjam' => 'datetime'
    ];
}
