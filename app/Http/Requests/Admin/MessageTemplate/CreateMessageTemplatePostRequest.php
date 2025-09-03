<?php

namespace App\Http\Requests\Admin\MessageTemplate;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageTemplatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // adjust if you want to add policies later
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:50'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,txt', 'max:10240'], // file optional, max 10MB

        ];
    }
}
