<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSavingTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tgl_transaksi' => 'required',
			'anggota_id' => 'required|exists:App\Models\User,id',
			'jenis_id' => 'required|exists:App\Models\SavingType,id',
			'jumlah' => 'required|numeric',
			'akun' => 'required|in:Setoran,Penarikan',
			'dk' => 'required|in:D,K',
			'kas_id' => 'required|exists:App\Models\CashType,id',
        ];
    }
}
