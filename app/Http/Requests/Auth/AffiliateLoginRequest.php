<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateLoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'whatsapp_phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
