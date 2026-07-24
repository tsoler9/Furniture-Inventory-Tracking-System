<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionTypeStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', 'unique:transaction_types,name'],
            'mode' => ['required', 'in:addition,deduction'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
