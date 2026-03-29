<?php

namespace App\Http\Requests\Seeker;

use App\Helpers\FakeDataHelper;
use Illuminate\Foundation\Http\FormRequest;

class AddExperienceRequest extends FormRequest
{
    public function rules(): array
    {
        $types = implode(',', FakeDataHelper::JOB_TYPES);
        return [
            'company'     => ['required', 'string', 'max:100'],
            'position'    => ['required', 'string', 'max:100'],
            'job_type'    => ['required', 'string', "in:{$types}"],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after:start_date'],
            'description' => ['nullable', 'string', 'max:1000'],
            'website'     => ['nullable', 'url', 'max:255'],
            'logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
        ];
    }
}
