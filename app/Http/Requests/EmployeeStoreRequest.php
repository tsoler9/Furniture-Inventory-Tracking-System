<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'position' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'in:admin,staff'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}
