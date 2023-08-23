<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCashTypeRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
			'aktif' => 'required|in:Y,T',
			'tmpl_simpan' => 'nullable|in:Y,T',
			'tmpl_penarikan' => 'nullable|in:Y,T',
			'tmpl_pinjaman' => 'nullable|in:Y,T',
			'tmpl_bayar' => 'nullable|in:Y,T',
			'tmpl_pemasukan' => 'nullable|in:Y,T',
			'tmpl_pengeluaran' => 'nullable|in:Y,T',
			'tmpl_transfer' => 'nullable|in:Y,T',
        ];
    }
}
