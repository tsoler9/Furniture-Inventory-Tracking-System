@extends('layouts.app')
@section('title', 'Transaction Types')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Transaction Types</h3>
    <a href="{{ route('transaction-types.create') }}" class="btn btn-primary">+ Add Type</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered bg-white">
    <thead>
        <tr><th>Name</th><th>Description</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @forelse ($transactionTypes as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td>{{ $type->description }}</td>
                <td>
                    <a href="{{ route('transaction-types.edit', $type) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('transaction-types.destroy', $type) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this transaction type?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center">No transaction types yet.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $transactionTypes->links() }}
@endsection
