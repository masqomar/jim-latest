<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCashTransactionRequest extends FormRequest
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
            'tgl_catat' => 'required',
			'jumlah' => 'required|numeric',
			'keterangan' => 'nullable|string|max:255',
			'akun' => 'nullable|in:Pemasukan,Pengeluaran,Transfer',
			'dari_kas_id' => 'nullable|exists:App\Models\CashType,id',
			'untuk_kas_id' => 'nullable|exists:App\Models\CashType,id',
			'jns_trans' => 'nullable|exists:App\Models\AccountType,id',
			'dk' => 'nullable|in:D,K',
        ];
    }
}
