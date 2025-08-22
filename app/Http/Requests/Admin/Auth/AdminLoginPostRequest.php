<?php

namespace App\Http\Requests\Admin\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;


class AdminLoginPostRequest extends FormRequest
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
                'exists:' . (new Admin)->getTable() . ',username',
            ],
            'password' => [
                'required',
                'string',
                'min:3',
                'max:25',
            ],
        ];
    }
}
