@extends('layouts.guest')
@section('title', '404 — Page Not Found')
@section('content')
    <div class="auth-shell">
        <div class="auth-card text-center">
            <div class="sku-tag mb-3">ERROR 404</div>
            <h2 class="mb-2">Page Not Found</h2>
            <p class="text-muted mb-4">The page you're looking for doesn't exist or may have been moved.</p>
            <a href="{{ auth()->check() ? route('dashboard.' . (auth()->user()->isAdmin() ? 'admin' : 'staff')) : route('login') }}"
                class="btn btn-primary">
                {{ auth()->check() ? 'Back to Dashboard' : 'Back to Login' }}
            </a>
        </div>
    </div>
@endsection
