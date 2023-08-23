<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KopProduct extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kop_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['nm_barang', 'type', 'merk', 'harga', 'jml_brg'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['nm_barang' => 'string', 'type' => 'string', 'merk' => 'string', 'harga' => 'integer', 'jml_brg' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
    

}
