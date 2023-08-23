<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKopProductRequest extends FormRequest
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
            'nm_barang' => 'required|string|max:255',
			'type' => 'nullable|string|max:255',
			'merk' => 'nullable|string|max:255',
			'harga' => 'required|numeric',
			'jml_brg' => 'required|numeric',
        ];
    }
}
