<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class RegisterUserPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:3',
                'max:25',
                'unique:App\Models\User,username'
            ],
            'first_name' => [
                'required',
                'string',
                'persian_alpha',
                'min:2',
                'max:60',
            ],
            'last_name' => [
                'required',
                'string',
                'persian_alpha',
                'min:2',
                'max:60',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:App\Models\User,email'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],

        ];
    }
}

