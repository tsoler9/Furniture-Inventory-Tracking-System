<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('employees', 'email')->ignore($this->employee)],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'position' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'in:admin,staff'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}

