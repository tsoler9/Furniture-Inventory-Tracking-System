@extends('layouts.app')
@section('title', 'Transaction History Report')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Transaction History Report</h3>
        <a href="{{ route('reports.transactions.export', request()->query()) }}" class="btn btn-primary btn-sm">
            <i class="bi bi-download"></i> Export CSV
        </a>
    </div>

    <form method="GET" class="row g-2 mb-4 align-items-end">
        <div class="col-auto">
            <label class="form-label small mb-0">From</label>
            <input type="date" name="from" value="{{ $from }}" class="form-control form-control-sm">
        </div>
        <div class="col-auto">
            <label class="form-label small mb-0">To</label>
            <input type="date" name="to" value="{{ $to }}" class="form-control form-control-sm">
        </div>
        <div class="col-auto">
            <label class="form-label small mb-0">Type</label>
            <select name="transaction_type_id" class="form-select form-select-sm">
                <option value="">All Types</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ (string) $typeId === (string) $type->id ? 'selected' : '' }}>
                        {{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            <a href="{{ route('reports.transactions') }}" class="btn btn-secondary btn-sm">Reset</a>
        </div>
    </form>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Type</th>
                <th>Qty</th>
                <th>Employee</th>
                <th>Reference</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                    <td>
                        {{ $transaction->product?->name ?? 'Deleted Product' }}
                        @if ($transaction->product)
                            <span class="sku-tag">{{ $transaction->product->sku }}</span>
                        @endif
                    </td>
                    <td>{{ $transaction->transactionType->name }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->employee?->name ?? 'Deleted Employee' }}</td>
                    <td>{{ $transaction->reference_no }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $transactions->links() }}
    <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">Back to Reports</a>
@endsection
