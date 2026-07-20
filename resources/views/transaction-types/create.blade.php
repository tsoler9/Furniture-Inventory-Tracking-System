@extends('layouts.app')
@section('title', 'Add Transaction Type')
@section('content')
<h3>Add Transaction Type</h3>
<form method="POST" action="{{ route('transaction-types.store') }}" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @include('transaction-types._form')
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('transaction-types.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
