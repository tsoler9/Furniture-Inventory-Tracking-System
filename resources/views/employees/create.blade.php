@extends('layouts.app')
@section('title', 'Add Employee')
@section('content')
<h3>Add Employee</h3>
<form method="POST" action="{{ route('employees.store') }}" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @include('employees._form')
    <button type="submit" class="btn btn-primary">Save Employee</button>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
