@extends('layouts.app')
@section('title', 'Edit Transaction Type')
@section('content')
    <h3>Edit Transaction Type</h3>
    <form method="POST" action="{{ route('transaction-types.update', $transactionType) }}"
        class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        @include('transaction-types._form')
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('transaction-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
