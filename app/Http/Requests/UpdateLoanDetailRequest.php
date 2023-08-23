<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanDetailRequest extends FormRequest
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
            'tgl_bayar' => 'required',
			'pinjam_id' => 'required|exists:App\Models\Loan,id',
			'angsuran_ke' => 'required|numeric',
			'jumlah_bayar' => 'required|numeric',
			'denda_rp' => 'nullable|numeric',
			'terlambat' => 'nullable|numeric',
			'ket_bayar' => 'required|in:Angsuran,Pelunasan,Bayar Denda',
			'dk' => 'nullable|in:D,K',
			'kas_id' => 'required|exists:App\Models\CashType,id',
			'jns_trans' => 'required|exists:App\Models\AccountType,id',
        ];
    }
}
