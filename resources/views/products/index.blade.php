@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Furniture Products</h3>
    <div>
        <a href="{{ route('products.trashed') }}" class="btn btn-secondary btn-sm">View Trash</a>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">+ Add Product</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>SKU</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Qty on Hand</th>
            <th>Status</th>
            <th>Actions</th>
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
                        <span class="badge bg-danger">Low Stock</span>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Move this product to trash?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center">No products yet.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}
@endsection
