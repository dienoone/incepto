<?php

namespace App\Http\Requests\Employer;

use App\Enums\JobArrangement;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Helpers\FakeDataHelper;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    public function rules(): array
    {
        $types        = implode(',', JobType::all());
        $arrangements = implode(',', JobArrangement::all());
        $levels       = implode(',', FakeDataHelper::JOB_LEVELS);
        $statuses     = implode(',', JobStatus::all());

        return [
            'title'            => ['required', 'string', 'max:150'],
            'description'      => ['required', 'string', 'min:100'],
            'address'          => ['required', 'string', 'max:150'],
            'type'             => ['required', "in:{$types}"],
            'level'            => ['required', "in:{$levels}"],
            'arrangement'      => ['required', "in:{$arrangements}"],
            'salary_min'       => ['required', 'integer', 'min:0'],
            'salary_max'       => ['required', 'integer', 'gt:salary_min'],
            'expires_at'       => ['required', 'date', 'after:today'],
            'status'           => ['sometimes', "in:{$statuses}"],
            'skills'           => ['nullable', 'array'],
            'skills.*'         => ['string', 'max:100'],
            'requirements'     => ['nullable', 'array'],
            'requirements.*'   => ['string', 'max:200'],
            'responsibilities' => ['nullable', 'array'],
            'responsibilities.*' => ['string', 'max:200'],
        ];
    }
}
