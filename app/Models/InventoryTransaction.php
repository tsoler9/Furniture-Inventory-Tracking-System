<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'employee_id', 'transaction_type_id', 'quantity', 'transaction_date', 'reference_no', 'remarks'];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withTrashed();
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    /**
     * Adjusts product stock based on transaction type.
     * $direction = 1 to apply the change (on create), -1 to reverse it (on delete).
     * Adjustment/Transfer types are intentionally not auto-applied — out of scope for this project.
     *
     * @param mixed $destroy
     */
    public function applyStockChange($destroy = false): void
    {
        if ($destroy) {
            $mode = ['addition' => 'decrement', 'deduction' => 'increment'][$this->transactionType->mode];
        } else {
            $mode = ['addition' => 'increment', 'deduction' => 'decrement'][$this->transactionType->mode];
        }

        $this->product->{$mode}('quantity_on_hand', $this->quantity);
    }

    protected function casts(): array
    {
        return [
            'transaction_date' => 'datetime',
        ];
    }
}
