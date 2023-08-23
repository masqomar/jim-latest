<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingType extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'saving_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['jns_simpan', 'jumlah', 'tampil'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['jns_simpan' => 'string', 'jumlah' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
    

}
