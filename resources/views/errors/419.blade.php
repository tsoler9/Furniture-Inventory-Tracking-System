@extends('layouts.guest')
@section('title', '419 — Session Expired')
@section('content')
    <div class="auth-shell">
        <div class="auth-card text-center">
            <div class="sku-tag mb-3">ERROR 419</div>
            <h2 class="mb-2">Session Expired</h2>
            <p class="text-muted mb-4">Your session timed out for security. Please refresh and try again.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Back to Login</a>
        </div>
    </div>
@endsection
