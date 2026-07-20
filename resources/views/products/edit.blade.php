@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<h3>Edit Product</h3>

<form method="POST" action="{{ route('products.update', $product) }}" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    @include('products._form')
    <button type="submit" class="btn btn-primary">Update Product</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
