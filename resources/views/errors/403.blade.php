@extends('layouts.guest')
@section('title', '403 — Access Denied')
@section('content')
    <div class="auth-shell">
        <div class="auth-card text-center">
            <div class="sku-tag mb-3">ERROR 403</div>
            <h2 class="mb-2">Access Denied</h2>
            <p class="text-muted mb-4">{{ $exception->getMessage() ?: "You don't have permission to view this page." }}</p>
            <a href="{{ auth()->check() ? route('dashboard.' . (auth()->user()->isAdmin() ? 'admin' : 'staff')) : route('login') }}"
                class="btn btn-primary">
                {{ auth()->check() ? 'Back to Dashboard' : 'Back to Login' }}
            </a>
        </div>
    </div>
@endsection
