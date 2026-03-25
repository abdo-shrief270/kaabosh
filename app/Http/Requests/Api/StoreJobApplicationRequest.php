<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullName' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'country' => ['required', 'string', 'max:100'],
            'cvFile' => ['required', 'file', 'mimes:pdf,docx', 'max:5120'],
            'linkedinUrl' => ['nullable', 'url', 'max:500'],
            'portfolioUrl' => ['nullable', 'url', 'max:500'],
            'coverLetter' => ['nullable', 'string', 'max:10000'],
            'referralSource' => ['nullable', 'string', 'max:255'],
            'referralName' => ['nullable', 'string', 'max:255'],
            'diversityGender' => ['nullable', 'string', 'max:50'],
            'diversityEthnicity' => ['nullable', 'string', 'max:100'],
            'diversityDisability' => ['nullable', 'string', 'max:50'],
        ];
    }
}
