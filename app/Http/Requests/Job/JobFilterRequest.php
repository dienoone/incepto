<?php

namespace App\Http\Requests\Job;

use App\Enums\JobArrangement;
use App\Enums\JobType;
use App\Helpers\FakeDataHelper;
use Illuminate\Foundation\Http\FormRequest;

class JobFilterRequest extends FormRequest
{
    public function rules(): array
    {
        $types        = implode(',', JobType::all());
        $arrangements = implode(',', JobArrangement::all());
        $levels       = implode(',', FakeDataHelper::JOB_LEVELS);

        return [
            'q'             => ['nullable', 'string', 'max:100'],
            'location'      => ['nullable', 'string', 'max:100'],
            'type'          => ['nullable', 'array'],
            'type.*'        => ["in:{$types}"],
            'arrangement'   => ['nullable', 'array'],
            'arrangement.*' => ["in:{$arrangements}"],
            'level'         => ['nullable', 'array'],
            'level.*'       => ["in:{$levels}"],
            'salary_min'    => ['nullable', 'integer', 'min:0'],
            'salary_max'    => ['nullable', 'integer', 'min:0'],
            'skills'        => ['nullable', 'array'],
            'sort'          => ['nullable', 'string', 'in:newest,oldest,salary_asc,salary_desc,popular'],
            'per_page'      => ['nullable', 'integer', 'in:15,30,50'],
        ];
    }

    public function filters(): array
    {
        return array_filter($this->validated(), fn($v) => $v !== null && $v !== '');
    }
}
