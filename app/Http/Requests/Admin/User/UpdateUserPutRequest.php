<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserPutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id ?? auth()->id(); // get user ID from route or auth

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
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'phone')->ignore($userId),
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
