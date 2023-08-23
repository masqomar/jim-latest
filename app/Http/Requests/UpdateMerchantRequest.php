<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateMerchantRequest extends FormRequest
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
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:255'],
            'mobile' => ['required', 'min:8', 'max:12'],
            'member_id' => ['required', 'unique:users,member_id,' . $this->merchant->id],
            'email' => ['required', 'email', 'unique:users,email,' . $this->merchant->id],
            'avatar' => ['nullable', 'image', 'max:1024'],
            'role' => ['required', 'exists:roles,id'],
            'password' =>  [
                'nullable',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ];
    }
}
