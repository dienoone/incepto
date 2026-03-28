<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'q'        => ['nullable', 'string', 'max:100'],
            'industry' => ['nullable', 'string', 'max:100'],
            'size'     => ['nullable', 'string', 'in:1-10,11-50,51-200,201-500,500+'],
            'hiring'   => ['nullable', 'boolean'],
            'sort'     => ['nullable', 'string', 'in:jobs,newest,oldest,followers,rating'],
        ];
    }

    public function filters(): array
    {
        return array_filter($this->validated(), fn($v) => $v !== null && $v !== '');
    }
}
