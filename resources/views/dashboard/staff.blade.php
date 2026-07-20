@extends('layouts.app')
@section('title', 'Staff Dashboard')
@section('content')
    <div class="mb-4">
        <h3 class="mb-1">Welcome back, {{ auth()->user()->name }}</h3>
        <p class="text-muted mb-0">Here's what's happening in the warehouse today.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-4">
            <div class="card-tag h-100">
                <div class="sku-tag mb-2">TOTAL</div>
                <div class="display-6" style="font-family: var(--font-display); color: var(--ember-900);">{{ $totalProducts }}
                </div>
                <div class="text-muted small">Products tracked</div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="card-tag h-100">
                <div class="sku-tag mb-2">ALERT</div>
                <div class="display-6" style="font-family: var(--font-display); color: var(--bs-danger);">
                    {{ $lowStockCount }}</div>
                <div class="text-muted small">Low stock items</div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="card-tag h-100">
                <div class="sku-tag mb-2">ACTIVITY</div>
                <div class="display-6" style="font-family: var(--font-display); color: var(--ember-900);">
                    {{ $totalTransactions }}</div>
                <div class="text-muted small">Transactions logged</div>
            </div>
        </div>
    </div>

    <div class="card-tag">
        <h5 class="mb-3">Quick actions</h5>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm me-2">View Products</a>
        <a href="{{ route('inventory-transactions.create') }}" class="btn btn-primary btn-sm">+ Record Transaction</a>
    </div>
@endsection
