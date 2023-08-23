<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

class User extends Authenticatable implements Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'mobile', 'country_code', 'cover', 'lat', 'lng', 'gender', 'verified', 'type',
        'dob', 'date', 'fcm_token', 'others', 'stripe_key', 'extra_field', 'status', 'member_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime:d/m/Y H:i',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'status' => 'integer',
        'gender' => 'integer',
        'verified' => 'integer',
        'password' => 'hashed',
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'payable_id', 'id');
    }

    // public function simpanan_sukarela()
    // {
    //     return $this->hasMany(SavingTransaction::class, 'anggota_id', 'id');
    // }
}
