<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryTransactionStoreRequest;
use App\Models\Employee;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\TransactionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InventoryTransactionController extends Controller
{
    public function index(): View
    {
        $transactions = InventoryTransaction::with(['product', 'employee', 'transactionType'])
            ->latest('transaction_date')
            ->paginate(10);

        return view('inventory-transactions.index', compact('transactions'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();
        $types = TransactionType::orderBy('name')->get();

        return view('inventory-transactions.create', compact('products', 'employees', 'types'));
    }

    public function store(InventoryTransactionStoreRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $transaction = InventoryTransaction::create($request->validated());
            $this->applyStockChange($transaction, 1);
        });

        return redirect()->route('inventory-transactions.index')->with('success', 'Transaction recorded and stock updated.');
    }

    public function destroy(InventoryTransaction $inventoryTransaction): RedirectResponse
    {
        DB::transaction(function () use ($inventoryTransaction) {
            $this->applyStockChange($inventoryTransaction, -1);
            $inventoryTransaction->delete();
        });

        return redirect()->route('inventory-transactions.index')->with('success', 'Transaction deleted and stock reverted.');
    }

    /**
     * Adjusts product stock based on transaction type.
     * $direction = 1 to apply the change (on create), -1 to reverse it (on delete).
     * Adjustment/Transfer types are intentionally not auto-applied — out of scope for this project.
     */
    private function applyStockChange(InventoryTransaction $transaction, int $direction): void
    {
        $typeName = $transaction->transactionType->name;

        $delta = match ($typeName) {
            'Stock In', 'Return' => $transaction->quantity,
            'Stock Out' => -$transaction->quantity,
            default => 0,
        };

        $transaction->product()->first()?->increment('quantity_on_hand', $delta * $direction);
    }
}
