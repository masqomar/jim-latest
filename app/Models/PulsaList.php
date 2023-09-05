<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PulsaList extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'sku', 'nama_produk', 'harga', 'margin', 'deskripsi'];
}
