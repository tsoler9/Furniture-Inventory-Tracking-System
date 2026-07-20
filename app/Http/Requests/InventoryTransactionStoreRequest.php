<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class InventoryTransactionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'transaction_type_id' => ['required', 'exists:transaction_types,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'transaction_date' => ['required', 'date'],
            'reference_no' => ['nullable', 'string', 'max:50'],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $type = TransactionType::find($this->transaction_type_id);
            $product = Product::find($this->product_id);

            if ($type && $product && $type->name === 'Stock Out' && $this->quantity > $product->quantity_on_hand) {
                $validator->errors()->add('quantity', "Not enough stock. Only {$product->quantity_on_hand} available.");
            }
        });
    }
}
