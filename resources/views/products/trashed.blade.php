@extends('layouts.app')
@section('title', 'Trashed Products')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Trashed Products</h3>
    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back to Products</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered bg-white">
    <thead>
        <tr><th>SKU</th><th>Name</th><th>Deleted At</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td><span class="sku-tag">{{ $product->sku }}</span></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->deleted_at->format('M d, Y g:i A') }}</td>
                <td>
                    <form action="{{ route('products.restore', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-primary">Restore</button>
                    </form>
                    <form action="{{ route('products.force-delete', $product->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Permanently delete this product? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Trash is empty.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $products->links() }}
@endsection
