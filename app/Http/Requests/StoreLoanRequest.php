<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'tgl_pinjam' => 'required',
			'anggota_id' => 'required|exists:App\Models\User,id',
			'barang_id' => 'required|exists:App\Models\KopProduct,id',
			'lama_angsuran' => 'required|numeric',
			'jumlah' => 'required|numeric',
			'biaya_adm' => 'required|numeric',
			'kas_id' => 'required|exists:App\Models\CashType,id',
        ];
    }
}
