@extends('layouts.guest')
@section('title', '500 — Something Went Wrong')
@section('content')
    <div class="auth-shell">
        <div class="auth-card text-center">
            <div class="sku-tag mb-3">ERROR 500</div>
            <h2 class="mb-2">Something Went Wrong</h2>
            <p class="text-muted mb-4">An unexpected error occurred on our end. Please try again shortly.</p>
            <a href="{{ auth()->check() ? route('dashboard.' . (auth()->user()->isAdmin() ? 'admin' : 'staff')) : route('login') }}"
                class="btn btn-primary">
                Back to Safety
            </a>
        </div>
    </div>
@endsection
