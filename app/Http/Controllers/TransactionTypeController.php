<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionTypeStoreRequest;
use App\Http\Requests\TransactionTypeUpdateRequest;
use App\Models\TransactionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionTypeController extends Controller
{
    public function index(): View
    {
        $transactionTypes = TransactionType::latest()->paginate(10);

        return view('transaction-types.index', compact('transactionTypes'));
    }

    public function create(): View
    {
        return view('transaction-types.create');
    }

    public function store(TransactionTypeStoreRequest $request): RedirectResponse
    {
        TransactionType::create($request->validated());

        return redirect()->route('transaction-types.index')->with('success', 'Transaction type added successfully.');
    }

    public function edit(TransactionType $transactionType): View
    {
        return view('transaction-types.edit', compact('transactionType'));
    }

    public function update(TransactionTypeUpdateRequest $request, TransactionType $transactionType): RedirectResponse
    {
        $transactionType->update($request->validated());

        return redirect()->route('transaction-types.index')->with('success', 'Transaction type updated successfully.');
    }

    public function destroy(TransactionType $transactionType): RedirectResponse
    {
        $transactionType->delete();

        return redirect()->route('transaction-types.index')->with('success', 'Transaction type deleted successfully.');
    }
}

