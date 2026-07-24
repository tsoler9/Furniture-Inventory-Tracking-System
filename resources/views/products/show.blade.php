@extends('layouts.app')
@section('title', $product->name)
@section('content')
  <h3>{{ $product->name }}</h3>
  <table class="table table-bordered bg-white w-50">
    <tr>
      <th>SKU</th>
      <td>{{ $product->sku }}</td>
    </tr>
    <tr>
      <th>Category</th>
      <td>{{ $product->category }}</td>
    </tr>
    <tr>
      <th>Unit Price</th>
      <td>₱{{ number_format($product->unit_price, 2) }}</td>
    </tr>
    <tr>
      <th>Quantity on Hand</th>
      <td>{{ $product->quantity_on_hand }}</td>
    </tr>
    <tr>
      <th>Reorder Level</th>
      <td>{{ $product->reorder_level }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>{{ ucfirst($product->status) }}</td>
    </tr>
  </table>
  <hr>
  <h3>Transaction History</h3>
  <table class="table table-bordered bg-white w-50">
    <thead>
      <tr>
        <th>Date</th>
        <th>Type</th>
        <th>Qty</th>
        <th>Employee</th>
        <th>Reference</th>
      </tr>
    </thead>
    <tbody>
      @forelse($product->transactions()->latest('transaction_date')->get() as $transaction)
        <tr>
          <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
          <td>{{ $transaction->transactionType->name }}</td>
          <td @class([
              'text-end',
              'text-black fw-bold' => $transaction->transactionType->mode == 'addition',
              'text-danger' => $transaction->transactionType->mode == 'deduction',
          ])>{{ $transaction->quantity }}</td>
          <td>{{ $transaction->employee?->name ?? 'Deleted Employee' }}</td>
          <td>{{ $transaction->reference_no }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5">No available transaction(s).</td>
        </tr>
      @endforelse
    </tbody>
  </table>
  <a href="{{ route('products.index') }}"
    class="btn btn-secondary">Back to Products</a>
@endsection
