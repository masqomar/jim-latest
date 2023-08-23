<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tgl_catat' => 'required',
			'jumlah' => 'required|numeric',
			'keterangan' => 'nullable|string|max:255',
			'untuk_kas_id' => 'required|exists:App\Models\CashType,id',
			'jns_trans' => 'required|exists:App\Models\AccountType,id',
        ];
    }
}
