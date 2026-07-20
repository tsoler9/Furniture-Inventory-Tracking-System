@extends('layouts.guest')
@section('title', 'Yohak — Furniture Inventory, Tracked to the Tag')
@section('content')

<header class="landing-hero">
    <div class="container text-center py-5">
        <div class="landing-brand mb-3">
            <span class="tag-dot" style="background: var(--gold-300);"></span> YOHAK
        </div>
        <h1 class="landing-headline">Furniture inventory,<br>tracked to the tag.</h1>
        <p class="landing-sub mx-auto">
            Yohak is a lightweight inventory system built for furniture businesses —
            log every product, record every stock movement, and know what's running low
            before it becomes a problem.
        </p>
        <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Create an Account</a>
        </div>
    </div>
</header>

<main class="landing-body">
    <div class="container py-5">
        <div class="text-center mb-5">
            <div class="sku-tag mb-2">WHAT'S INSIDE</div>
            <h2>Everything you need to manage stock</h2>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card-tag h-100">
                    <i class="bi bi-box-seam landing-feature-icon"></i>
                    <h5 class="mt-3">Product Catalog</h5>
                    <p class="text-muted small mb-0">Track every piece by SKU, category, and price — with automatic low-stock flags when reorder levels are hit.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-tag h-100">
                    <i class="bi bi-arrow-repeat landing-feature-icon"></i>
                    <h5 class="mt-3">Transaction Logging</h5>
                    <p class="text-muted small mb-0">Every stock in, stock out, and adjustment is recorded — with who made the change and when.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-tag h-100">
                    <i class="bi bi-shield-lock landing-feature-icon"></i>
                    <h5 class="mt-3">Role-Based Access</h5>
                    <p class="text-muted small mb-0">Admins manage employees and full inventory control; staff handle day-to-day stock movements.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-tag h-100">
                    <i class="bi bi-people landing-feature-icon"></i>
                    <h5 class="mt-3">Built for Teams</h5>
                    <p class="text-muted small mb-0">Multiple employees, one shared source of truth for what's actually on the shelves.</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="landing-step-number">01</div>
                <h6>Sign in</h6>
                <p class="text-muted small">Use your employee account, or register a new one to get started.</p>
            </div>
            <div class="col-md-4">
                <div class="landing-step-number">02</div>
                <h6>Log activity</h6>
                <p class="text-muted small">Add products, record stock movements, and keep transaction history accurate.</p>
            </div>
            <div class="col-md-4">
                <div class="landing-step-number">03</div>
                <h6>Monitor stock health</h6>
                <p class="text-muted small">Your dashboard shows live counts and low-stock alerts at a glance.</p>
            </div>
        </div>
    </div>
</main>

<footer class="landing-footer text-center py-4">
    <p class="mb-0 small text-muted">&copy; {{ date('Y') }} Yohak — Furniture inventory, tracked with care.</p>
</footer>

@endsection
