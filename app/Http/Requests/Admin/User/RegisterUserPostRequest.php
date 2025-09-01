<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'persian_alpha',
                'min:2',
                'max:60',
            ],
            'last_name' => [
                'nullable',
                'string',
                'persian_alpha',
                'min:2',
                'max:60',
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone',
            ],
            'gender' => [
                'nullable',
                Rule::in(['male', 'female', 'other']),
            ],
            'birthday' => [
                'nullable',
                'date',
            ],
            'organization' => [
                'nullable',
                'string',
                'max:255',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
            'extra' => [
                'nullable',
                'array',
            ],
        ];
    }
}
