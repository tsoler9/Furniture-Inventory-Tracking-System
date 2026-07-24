<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryTransactionStoreRequest;
use App\Models\{Employee, InventoryTransaction, Product, TransactionType};
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
        try {
            DB::transaction(function () use ($request) {
                $transaction = InventoryTransaction::create($request->validated());

                $this->applyStockChange($transaction);

                return true;
            });
        } catch (\Throwable $exception) {
            return back()->with(['error' => $exception->getMessage()])
                ->withInput();
        }

        return redirect()->route('inventory-transactions.index')->with('success', 'Transaction recorded and stock updated.');
    }

    public function destroy(InventoryTransaction $inventoryTransaction): RedirectResponse
    {
        DB::transaction(function () use ($inventoryTransaction) {
            $this->applyStockChange($inventoryTransaction, true);
            $inventoryTransaction->delete();
        });

        return redirect()->route('inventory-transactions.index')->with('success', 'Transaction deleted and stock reverted.');
    }

    /**
     * Adjusts product stock based on transaction type.
     * $direction = 1 to apply the change (on create), -1 to reverse it (on delete).
     * Adjustment/Transfer types are intentionally not auto-applied — out of scope for this project.
     *
     * @param mixed $destroy
     */
    private function applyStockChange(InventoryTransaction $transaction, $destroy = false): void
    {
        $mode = ['addition' => 'increment', 'deduction' => 'decrement'][$transaction->transactionType->mode];

        $quantity = $transaction->quantity;

        if ($destroy) {
            $quantity = $quantity * -1;
        }

        $transaction->product->{$mode}('quantity_on_hand', $transaction->quantity);
    }
}
