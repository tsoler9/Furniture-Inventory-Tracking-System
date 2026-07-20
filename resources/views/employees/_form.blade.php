@php $employee = $employee ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $employee?->name) }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $employee?->email) }}"
           class="form-control @error('email') is-invalid @enderror">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Password {{ $employee ? '(leave blank to keep current)' : '' }}</label>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Position</label>
    <input type="text" name="position" value="{{ old('position', $employee?->position) }}" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role" class="form-select">
        <option value="staff" {{ old('role', $employee?->role) === 'staff' ? 'selected' : '' }}>Staff</option>
        <option value="admin" {{ old('role', $employee?->role) === 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="active" {{ old('status', $employee?->status) === 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status', $employee?->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
