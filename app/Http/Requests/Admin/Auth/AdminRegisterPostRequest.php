<?php

namespace App\Http\Requests\Admin\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;


class AdminRegisterPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return  [
            'username' => [
                'required',
                'string',
                'min:3',
                'max:25',
                'unique:' . (new Admin)->getTable() . ',username',
            ],
            'first_name' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:' . (new Admin)->getTable() . ',email',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],

        ];
    }
}
