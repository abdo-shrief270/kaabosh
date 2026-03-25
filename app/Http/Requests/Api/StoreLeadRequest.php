<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'firstName' => ['nullable', 'string', 'max:255'],
            'productInterest' => ['nullable', 'string', 'max:255'],
        ];
    }
}
