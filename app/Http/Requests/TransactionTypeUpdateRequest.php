<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionTypeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('transaction_types', 'name')->ignore($this->transaction_type)],
            'mode' => ['required', 'in:addition,deduction'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}

