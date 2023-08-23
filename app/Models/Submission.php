<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'submissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['no_ajuan', 'ajuan_id', 'anggota_id', 'tgl_input', 'jenis', 'nominal', 'lama_ags', 'keterangan', 'status', 'alasan', 'tgl_cair'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['no_ajuan' => 'integer', 'ajuan_id' => 'string', 'tgl_input' => 'datetime:d/m/Y H:i', 'jenis' => 'string', 'nominal' => 'integer', 'lama_ags' => 'integer', 'keterangan' => 'string', 'alasan' => 'string', 'tgl_cair' => 'date:d/m/Y', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];
    
	
	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'anggota_id', 'id');
    }
}
