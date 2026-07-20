<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('reports.index');
    }

    public function stockSummary(Request $request): View
    {
        $category = $request->query('category');

        $products = Product::query()
            ->when($category, fn($query) => $query->where('category', $category))
            ->orderBy('name')
            ->get();

        $categories = Product::query()->select('category')->distinct()->whereNotNull('category')->pluck('category');
        $totalValue = $products->sum(fn($product) => $product->unit_price * $product->quantity_on_hand);
        $lowStockCount = $products->filter(fn($product) => $product->quantity_on_hand <= $product->reorder_level)->count();

        return view('reports.stock-summary', compact('products', 'categories', 'category', 'totalValue', 'lowStockCount'));
    }

    public function exportStockSummary(Request $request): StreamedResponse
    {
        $category = $request->query('category');

        $products = Product::query()
            ->when($category, fn($query) => $query->where('category', $category))
            ->orderBy('name')
            ->get();

        $filename = 'stock-summary-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($products) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['SKU', 'Name', 'Category', 'Unit Price', 'Qty on Hand', 'Reorder Level', 'Status']);

            foreach ($products as $product) {
                fputcsv($handle, [
                    $product->sku,
                    $product->name,
                    $product->category,
                    $product->unit_price,
                    $product->quantity_on_hand,
                    $product->reorder_level,
                    $product->status,
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function transactionHistory(Request $request): View
    {
        $from = $request->query('from');
        $to = $request->query('to');
        $typeId = $request->query('transaction_type_id');

        $transactions = InventoryTransaction::with(['product', 'employee', 'transactionType'])
            ->when($from, fn($query) => $query->whereDate('transaction_date', '>=', $from))
            ->when($to, fn($query) => $query->whereDate('transaction_date', '<=', $to))
            ->when($typeId, fn($query) => $query->where('transaction_type_id', $typeId))
            ->latest('transaction_date')
            ->paginate(15)
            ->withQueryString();

        $types = TransactionType::orderBy('name')->get();

        return view('reports.transactions', compact('transactions', 'types', 'from', 'to', 'typeId'));
    }

    public function exportTransactions(Request $request): StreamedResponse
    {
        $from = $request->query('from');
        $to = $request->query('to');
        $typeId = $request->query('transaction_type_id');

        $transactions = InventoryTransaction::with(['product', 'employee', 'transactionType'])
            ->when($from, fn($query) => $query->whereDate('transaction_date', '>=', $from))
            ->when($to, fn($query) => $query->whereDate('transaction_date', '<=', $to))
            ->when($typeId, fn($query) => $query->where('transaction_type_id', $typeId))
            ->latest('transaction_date')
            ->get();

        $filename = 'transaction-history-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($transactions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Date', 'Product', 'SKU', 'Type', 'Quantity', 'Employee', 'Reference No', 'Remarks']);

            foreach ($transactions as $transaction) {
                fputcsv($handle, [
                    $transaction->transaction_date->format('Y-m-d'),
                    $transaction->product->name,
                    $transaction->product->sku,
                    $transaction->transactionType->name,
                    $transaction->quantity,
                    $transaction->employee->name,
                    $transaction->reference_no,
                    $transaction->remarks,
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}

