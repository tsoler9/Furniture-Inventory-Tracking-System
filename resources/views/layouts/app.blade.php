<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yohak — Furniture Inventory')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;600;700&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>

<body>
    @auth
        <nav class="navbar navbar-expand-lg navbar-brand-gradient mb-4">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard.' . (auth()->user()->isAdmin() ? 'admin' : 'staff')) }}">
                    <span class="tag-dot"></span> YOHAK
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav ms-auto align-items-lg-center">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                        <a class="nav-link" href="{{ route('transaction-types.index') }}">Transaction Types</a>
                        <a class="nav-link" href="{{ route('inventory-transactions.index') }}">Transactions</a>
                        <a class="nav-link" href="{{ route('reports.index') }}">Reports</a>
                        @if (auth()->user()->isAdmin())
                            <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                        @endif
                        <a class="nav-link" href="{{ route('profile.edit') }}">My Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="ms-lg-2 mt-2 mt-lg-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    @endauth
    <div class="container pb-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 3500);
            });
        });
    </script>
</body>

</html>
