<?php

namespace App\Http\Requests\Employer;

use App\Enums\JobArrangement;
use App\Enums\JobType;
use App\Helpers\FakeDataHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    public function rules(): array
    {
        $types        = implode(',', JobType::all());
        $arrangements = implode(',', JobArrangement::all());
        $levels       = implode(',', FakeDataHelper::JOB_LEVELS);

        return [
            'title'       => ['sometimes', 'string', 'max:150'],
            'description' => ['sometimes', 'string', 'min:100'],
            'address'     => ['sometimes', 'string', 'max:150'],
            'type'        => ['sometimes', "in:{$types}"],
            'level'       => ['sometimes', "in:{$levels}"],
            'arrangement' => ['sometimes', "in:{$arrangements}"],
            'salary_min'  => ['sometimes', 'integer', 'min:0'],
            'salary_max'  => ['sometimes', 'integer', 'gt:salary_min'],
            'expires_at'  => ['sometimes', 'date', 'after:today'],
            'skills'      => ['nullable', 'array'],
            'skills.*'    => ['string'],
        ];
    }
}
