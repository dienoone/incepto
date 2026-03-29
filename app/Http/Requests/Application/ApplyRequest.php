<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ApplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->seeker !== null;
    }

    public function rules(): array
    {
        return [
            'expected_salary' => ['required', 'integer', 'min:0'],
            'cover_letter'    => ['nullable', 'string', 'max:3000'],
            'message'         => ['nullable', 'string', 'max:2000'],
            'attachment'      => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'attachment.required' => 'Please upload your CV or resume.',
            'attachment.mimes'    => 'Only PDF, DOC, or DOCX files are accepted.',
            'attachment.max'      => 'File size must not exceed 5MB.',
        ];
    }

    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException(
            'You must be logged in as a job seeker to apply.'
        );
    }
}
