<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
  use HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'loans';

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = ['tgl_pinjam', 'anggota_id', 'barang_id', 'lama_angsuran', 'jumlah', 'bunga', 'biaya_adm', 'lunas', 'dk', 'kas_id', 'jns_trans'];

  /**
   * The attributes that should be cast.
   *
   * @var string[]
   */
  protected $casts = ['tgl_pinjam' => 'datetime:d/m/Y H:i', 'lama_angsuran' => 'integer', 'jumlah' => 'integer', 'bunga' => 'float', 'biaya_adm' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];


  public function user()
  {
    return $this->belongsTo(\App\Models\User::class, 'anggota_id', 'id');
  }
  public function kop_product()
  {
    return $this->belongsTo(\App\Models\KopProduct::class, 'barang_id', 'id');
  }
  public function cash_type()
  {
    return $this->belongsTo(\App\Models\CashType::class, 'kas_id', 'id');
  }
  public function account_type()
  {
    return $this->belongsTo(\App\Models\AccountType::class, 'jns_trans', 'id');
  }
}
