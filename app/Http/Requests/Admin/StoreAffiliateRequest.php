<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAffiliateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'whatsapp_phone' => ['required', 'string', 'max:20', 'unique:users,whatsapp_phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'commission_rate' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
