<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountTypeRequest extends FormRequest
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
            'kd_aktiva' => 'required|string|max:255',
			'jns_trans' => 'required|string|max:255',
			'akun' => 'nullable|in:Aktiva,Pasiva',
			'laba_rugi' => 'nullable|in:PENDAPATAN,BIAYA',
			'pemasukan' => 'nullable|in:Y,N',
			'pengeluaran' => 'nullable|in:Y,N',
			'aktif' => 'required|in:Y,N',
        ];
    }
}
