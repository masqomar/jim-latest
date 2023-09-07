<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanPaymentRequest extends FormRequest
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
            'tgl_bayar' => 'required|date',
            'pinjam_id' => 'required|numeric',
            'angsuran_ke' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric',
            'kas_id' => 'required|numeric',
            'ket_bayar' => 'required|string|max:255',
        ];
    }
}
