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

                $transaction->applyStockChange($transaction);

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
            $inventoryTransaction->applyStockChange($inventoryTransaction, true);
            $inventoryTransaction->delete();
        });

        return redirect()->route('inventory-transactions.index')->with('success', 'Transaction deleted and stock reverted.');
    }
}
