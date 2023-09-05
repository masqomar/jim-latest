<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigiflazzAccount extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'api_key', 'webhook_id', 'secret_key'];
}
