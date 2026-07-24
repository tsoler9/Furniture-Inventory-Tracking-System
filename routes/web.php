<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionTypeController;
use App\Models\Employee;
use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->isAdmin() ? 'dashboard.admin' : 'dashboard.staff');
    }

    return view('landing');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin', [
            'totalProducts' => Product::count(),
            'lowStockCount' => Product::whereColumn('quantity_on_hand', '<=', 'reorder_level')->count(),
            'totalEmployees' => Employee::count(),
            'totalTransactions' => InventoryTransaction::count(),
        ]);
    })->name('dashboard.admin');

    Route::get('/dashboard/staff', function () {
        return view('dashboard.staff', [
            'totalProducts' => Product::count(),
            'lowStockCount' => Product::whereColumn('quantity_on_hand', '<=', 'reorder_level')->count(),
            'totalTransactions' => InventoryTransaction::count(),
        ]);
    })->name('dashboard.staff');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::patch('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore')->withTrashed();
    Route::delete('/products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete')->withTrashed();
    Route::resource('products', ProductController::class);

    Route::resource('transaction-types', TransactionTypeController::class)->except(['show']);
    Route::resource('inventory-transactions', InventoryTransactionController::class)->except(['show', 'edit', 'update']);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/stock-summary', [ReportController::class, 'stockSummary'])->name('reports.stock-summary');
    Route::get('/reports/stock-summary/export', [ReportController::class, 'exportStockSummary'])->name('reports.stock-summary.export');
    Route::get('/reports/transactions', [ReportController::class, 'transactionHistory'])->name('reports.transactions');
    Route::get('/reports/transactions/export', [ReportController::class, 'exportTransactions'])->name('reports.transactions.export');

    Route::middleware('admin')->group(function () {
        Route::resource('employees', EmployeeController::class)->except(['show']);
    });
});

