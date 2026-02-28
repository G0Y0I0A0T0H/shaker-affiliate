<?php

namespace App\Http\Requests\Affiliate;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'customer_address' => ['required', 'string', 'max:1000'],
            'customer_notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'items.*.variant_size_id' => ['required', 'integer', 'exists:variant_sizes,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
