@extends('layouts.app')
@section('title', 'Edit Employee')
@section('content')
    <h3>Edit Employee</h3>
    <form method="POST" action="{{ route('employees.update', $employee) }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        @include('employees._form')
        <button type="submit" class="btn btn-primary">Update Employee</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
