<?php

namespace App\Http\Requests\Merchant\MerchantUser;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MerchantUserRegisterRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            'name' => ['required'],
            'email' => ['nullable', 'email'],
            'phone_number' => ['required', 'integer', 'digits:12'],
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ];
    }
}
