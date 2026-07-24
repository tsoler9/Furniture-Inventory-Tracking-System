@extends('layouts.app')
@section('title', 'Record Transaction')
@section('content')
  <h3>Record Inventory Transaction</h3>

  @session('error')
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endsession

  <form method="POST"
    action="{{ route('inventory-transactions.store') }}"
    class="bg-white p-4 rounded shadow-sm">
    @csrf
    @include('inventory-transactions._form')
    <button type="submit"
      class="btn btn-primary">Save Transaction</button>
    <a href="{{ route('inventory-transactions.index') }}"
      class="btn btn-secondary">Cancel</a>
  </form>
@endsection
