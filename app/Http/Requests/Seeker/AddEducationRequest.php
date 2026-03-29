<?php

namespace App\Http\Requests\Seeker;

use Illuminate\Foundation\Http\FormRequest;

class AddEducationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'school'         => ['required', 'string', 'max:100'],
            'degree'         => ['required', 'string', 'max:100'],
            'field_of_study' => ['required', 'string', 'max:100'],
            'address'        => ['required', 'string', 'max:100'],
            'start_year'     => ['required', 'digits:4', 'integer', 'min:1950', 'max:' . date('Y')],
            'end_year'       => ['nullable', 'digits:4', 'integer', 'min:1950', 'max:' . (date('Y') + 6)],
            'description'    => ['nullable', 'string', 'max:500'],
        ];
    }
}
