@extends('layouts.app')
@section('title', 'Reports')
@section('content')
<h3 class="mb-4">Reports</h3>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card-tag h-100">
            <div class="sku-tag mb-2">INVENTORY</div>
            <h5>Stock Summary</h5>
            <p class="text-muted small">Current stock levels, value on hand, and low-stock items across your catalog.</p>
            <a href="{{ route('reports.stock-summary') }}" class="btn btn-primary btn-sm">View Report</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-tag h-100">
            <div class="sku-tag mb-2">ACTIVITY</div>
            <h5>Transaction History</h5>
            <p class="text-muted small">Every stock movement, filterable by date range and transaction type.</p>
            <a href="{{ route('reports.transactions') }}" class="btn btn-primary btn-sm">View Report</a>
        </div>
    </div>
</div>
@endsection
