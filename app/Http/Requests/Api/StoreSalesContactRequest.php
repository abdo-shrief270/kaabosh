<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'teamSize' => ['required', 'string', 'max:50'],
            'productInterest' => ['nullable', 'array'],
            'productInterest.*' => ['string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
