<?php

declare(strict_types=1);

namespace App\Http\Requests\Merchant\MerchantUser;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {
    public function rules(): array {
        return [
            'phone' => ['integer', 'required'],
            'password' => ['string', 'required'],
        ];
    }
}
