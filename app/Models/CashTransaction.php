<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CashTransaction extends Model
{
  use HasFactory, LogsActivity;

  public function getActivitylogOptions(): LogOptions
  {
      return LogOptions::defaults()
          ->useLogName('Transaksi Kas')
          ->logOnly(['jumlah', 'tgl_catat', 'keterangan', 'akun', 'dari_kas_id', 'untuk_kas_id', 'jns_trans', 'dk']);
      // ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
  }

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cash_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['tgl_catat', 'jumlah', 'keterangan', 'akun', 'dari_kas_id', 'untuk_kas_id', 'jns_trans', 'dk'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['tgl_catat' => 'datetime:d/m/Y H:i', 'jumlah' => 'integer', 'keterangan' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
    
	
	public function from_cash_type()
	{
		return $this->belongsTo(\App\Models\CashType::class, 'dari_kas_id', 'id');
    }	
	public function to_cash_type()
	{
		return $this->belongsTo(\App\Models\CashType::class, 'untuk_kas_id', 'id');
    }	
	public function account_type()
	{
		return $this->belongsTo(\App\Models\AccountType::class, 'jns_trans', 'id');
    }
}
