<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserTopup extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Topup JIMPay')
            ->logOnly(['user.first_name', 'amount', 'date', 'note', 'status']);
        // ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'amount', 'date', 'note', 'status'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['amount' => 'integer', 'date' => 'date:d/m/Y', 'note' => 'string', 'status' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];



    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
