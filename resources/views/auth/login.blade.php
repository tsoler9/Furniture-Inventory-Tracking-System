@extends('layouts.guest')
@section('title', 'Sign in — Yohak')
@section('content')
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-brand"><span class="tag-dot" style="background: var(--rust-600);"></span> YOHAK</div>
            <p class="auth-tagline">Furniture inventory, tracked with care.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $rememberedEmail) }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input"
                        {{ $rememberedEmail ? 'checked' : '' }}>
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </form>
            <p class="text-center mt-4 mb-0 small">No account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
@endsection
