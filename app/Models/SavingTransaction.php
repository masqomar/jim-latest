<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SavingTransaction extends Model
{
  use HasFactory, LogsActivity;
  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->useLogName('Transaksi Simpanan')
      ->logOnly(['user.first_name', 'jenis_id', 'jumlah', 'tgl_transaksi', 'keterangan', 'kas_id']);
    // ->setDescriptionForEvent(fn (string $eventName) ,=> "This model has been {$eventName}");
  }
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'saving_transactions';

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = ['tgl_transaksi', 'anggota_id', 'jenis_id', 'jumlah', 'keterangan', 'akun', 'dk', 'kas_id'];

  /**
   * The attributes that should be cast.
   *
   * @var string[]
   */
  protected $casts = ['tgl_transaksi' => 'datetime:d/m/Y H:i', 'jumlah' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];


  public function user()
  {
    return $this->belongsTo(\App\Models\User::class, 'anggota_id', 'id');
  }
  public function saving_type()
  {
    return $this->belongsTo(\App\Models\SavingType::class, 'jenis_id', 'id');
  }
  public function cash_type()
  {
    return $this->belongsTo(\App\Models\CashType::class, 'kas_id', 'id');
  }
}
