<?php

declare(strict_types=1);

namespace App\Http\Requests\Merchant\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class MerchantUpdateRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:25'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
        ];
    }
}
