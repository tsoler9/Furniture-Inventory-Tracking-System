@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
    <h3 class="mb-4">My Profile</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        <div class="col-md-7">
            <div class="card-tag">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $employee->name) }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" value="{{ old('position', $employee->position) }}"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password <span class="text-muted small">(leave blank to keep
                                current)</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-tag">
                <div class="sku-tag mb-2">ACCOUNT INFO</div>
                <p class="mb-1"><strong>Role:</strong> <span
                        class="badge {{ $employee->isAdmin() ? 'bg-primary' : 'bg-secondary' }}">{{ ucfirst($employee->role) }}</span>
                </p>
                <p class="mb-0"><strong>Status:</strong> <span
                        class="badge {{ $employee->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($employee->status) }}</span>
                </p>
                <p class="text-muted small mt-3 mb-0">Role and status are managed by an administrator.</p>
            </div>
        </div>
    </div>
@endsection
