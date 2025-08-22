<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminPutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $adminId = $this->route('admin'); // matches route parameter name

        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'username'   => ['required', 'string', 'max:50', 'unique:admins,username,' . $adminId],
            'email'      => ['required', 'email', 'max:255', 'unique:admins,email,' . $adminId],
            'password'   => ['nullable', 'string', 'min:6'],
            'is_super'   => ['required', 'boolean'],
            'is_active'  => ['required', 'boolean'],
            'images.*'   => ['nullable', 'image', 'max:2048'],
        ];
    }
}
