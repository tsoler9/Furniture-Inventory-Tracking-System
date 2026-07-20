@extends('layouts.app')
@section('title', $product->name)
@section('content')
<h3>{{ $product->name }}</h3>
<table class="table table-bordered bg-white w-50">
    <tr><th>SKU</th><td>{{ $product->sku }}</td></tr>
    <tr><th>Category</th><td>{{ $product->category }}</td></tr>
    <tr><th>Unit Price</th><td>₱{{ number_format($product->unit_price, 2) }}</td></tr>
    <tr><th>Quantity on Hand</th><td>{{ $product->quantity_on_hand }}</td></tr>
    <tr><th>Reorder Level</th><td>{{ $product->reorder_level }}</td></tr>
    <tr><th>Status</th><td>{{ ucfirst($product->status) }}</td></tr>
</table>
<a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
@endsection

