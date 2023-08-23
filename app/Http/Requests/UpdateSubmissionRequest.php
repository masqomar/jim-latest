<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubmissionRequest extends FormRequest
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
            'no_ajuan' => 'required|numeric',
			'ajuan_id' => 'required|string|max:255',
			'anggota_id' => 'required|exists:App\Models\User,id',
			'tgl_input' => 'required',
			'jenis' => 'required|string|max:255',
			'nominal' => 'required|numeric',
			'lama_ags' => 'required|numeric',
			'keterangan' => 'required|string|max:255',
			'status' => 'required|numeric',
			'alasan' => 'nullable|string|max:255',
			'tgl_cair' => 'nullable|date',
        ];
    }
}
