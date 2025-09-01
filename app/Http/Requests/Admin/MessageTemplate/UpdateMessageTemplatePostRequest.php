<?php

namespace App\Http\Requests\Admin\MessageTemplate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageTemplatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:50'],
        ];
    }
}
