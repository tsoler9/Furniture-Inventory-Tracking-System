@extends('layouts.app')
@section('title', 'Stock Summary Report')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Stock Summary Report</h3>
        <a href="{{ route('reports.stock-summary.export', request()->query()) }}" class="btn btn-primary btn-sm">
            <i class="bi bi-download"></i> Export CSV
        </a>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-auto">
            <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-4">
            <div class="card-tag h-100">
                <div class="sku-tag mb-2">ITEMS</div>
                <div class="display-6" style="font-family: var(--font-display); color: var(--ember-900);">
                    {{ $products->count() }}</div>
                <div class="text-muted small">Products listed</div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="card-tag h-100">
                <div class="sku-tag mb-2">VALUE</div>
                <div class="display-6" style="font-family: var(--font-display); color: var(--ember-900);">
                    ₱{{ number_format($totalValue, 0) }}</div>
                <div class="text-muted small">Total stock value</div>
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
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Qty on Hand</th>
                <th>Reorder Level</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><span class="sku-tag">{{ $product->sku }}</span></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>₱{{ number_format($product->unit_price, 2) }}</td>
                    <td>
                        {{ $product->quantity_on_hand }}
                        @if ($product->quantity_on_hand <= $product->reorder_level)
                            <span class="badge bg-danger">Low</span>
                        @endif
                    </td>
                    <td>{{ $product->reorder_level }}</td>
                    <td><span
                            class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($product->status) }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">Back to Reports</a>
@endsection
