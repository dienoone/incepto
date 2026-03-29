<?php

namespace App\Http\Requests\Seeker;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'string', 'max:50'],
            'last_name'  => ['sometimes', 'string', 'max:50'],
            'phone'      => ['sometimes', 'string', 'max:20'],
            'bio'        => ['sometimes', 'string', 'max:1000'],
            'avatar'     => ['sometimes', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
