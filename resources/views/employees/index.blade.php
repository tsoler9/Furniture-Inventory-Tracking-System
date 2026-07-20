@extends('layouts.app')
@section('title', 'Employees')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Employees</h3>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Add Employee</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>
                        <span class="badge {{ $employee->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                            {{ ucfirst($employee->role) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $employee->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">Edit</a>
                        @if ($employee->id !== auth()->id())
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this employee?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No employees yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $employees->links() }}
@endsection
