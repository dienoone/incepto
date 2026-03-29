<?php

namespace App\Http\Requests\Seeker;

use App\Enums\AttachmentType;
use Illuminate\Foundation\Http\FormRequest;

class AddAttachmentRequest extends FormRequest
{
    public function rules(): array
    {
        $types = implode(',', AttachmentType::all());
        return [
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', "in:{$types}"],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }
}
