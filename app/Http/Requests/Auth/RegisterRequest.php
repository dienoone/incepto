<?php

namespace App\Http\Requests\Auth;

use App\Enums\RoleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'role'       => ['required', 'string', 'in:' . implode(',', [RoleType::SEEKER->value, RoleType::COMPANY->value])],
            'terms'      => ['required', 'accepted'],
        ];

        // Company name required only when registering as employer
        if ($this->input('role') === RoleType::COMPANY->value) {
            $rules['company_name'] = ['required', 'string', 'max:100'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'role.in'           => 'Please select a valid account type.',
            'terms.accepted'    => 'You must accept the terms of service.',
            'company_name.required' => 'Please enter your company name.',
        ];
    }
}
