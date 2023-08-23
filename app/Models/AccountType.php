<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['kd_aktiva', 'jns_trans', 'akun', 'laba_rugi', 'pemasukan', 'pengeluaran', 'aktif'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['kd_aktiva' => 'string', 'jns_trans' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
    

}
