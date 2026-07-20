@extends('layouts.app')
@section('title', 'Inventory Transactions')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Inventory Transactions</h3>
        <a href="{{ route('inventory-transactions.create') }}" class="btn btn-primary">+ Record Transaction</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Type</th>
                <th>Qty</th>
                <th>Employee</th>
                <th>Reference</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                    <td>{{ $transaction->product?->name ?? 'Deleted Product' }}</td>
                    <td>{{ $transaction->transactionType->name }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->employee?->name ?? 'Deleted Employee' }}</td>
                    <td>{{ $transaction->reference_no }}</td>
                    <td>
                        <form action="{{ route('inventory-transactions.destroy', $transaction) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Delete this transaction? Stock will be reverted.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No transactions yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $transactions->links() }}
@endsection
