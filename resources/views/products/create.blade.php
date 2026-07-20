@extends('layouts.app')
@section('title', 'Add Product')
@section('content')
<h3>Add Product</h3>

<form method="POST" action="{{ route('products.store') }}" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @include('products._form')
    <button type="submit" class="btn btn-primary">Save Product</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

