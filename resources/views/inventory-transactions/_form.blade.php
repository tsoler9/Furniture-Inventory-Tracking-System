<div class="mb-3">
  <label class="form-label">Product</label>
  <select name="product_id"
    class="form-select @error('product_id') is-invalid @enderror">
    <option value="">-- Select Product --</option>
    @foreach ($products as $product)
      <option value="{{ $product->id }}"
        {{ old('product_id') == $product->id ? 'selected' : '' }}>
        {{ $product->name }} ({{ $product->sku }}) — Qty: {{ $product->quantity_on_hand }}
      </option>
    @endforeach
  </select>
  @error('product_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Employee</label>
  <select name="employee_id"
    class="form-select @error('employee_id') is-invalid @enderror">
    <option value="">-- Select Employee --</option>
    @foreach ($employees as $employee)
      <option value="{{ $employee->id }}"
        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
        {{ $employee->name }}
      </option>
    @endforeach
  </select>
  @error('employee_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Transaction Type</label>
  <select name="transaction_type_id"
    class="form-select @error('transaction_type_id') is-invalid @enderror">
    <option value="">-- Select Type --</option>
    @foreach ($types as $type)
      <option value="{{ $type->id }}"
        {{ old('transaction_type_id') == $type->id ? 'selected' : '' }}>
        {{ $type->name }}
      </option>
    @endforeach
  </select>
  @error('transaction_type_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Quantity</label>
  <input type="number"
    name="quantity"
    value="{{ old('quantity') }}"
    class="form-control @error('quantity') is-invalid @enderror">
  @error('quantity')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Transaction Date</label>
  <input type="date"
    name="transaction_date"
    value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
    class="form-control @error('transaction_date') is-invalid @enderror">
  @error('transaction_date')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Reference No.</label>
  <input type="text"
    name="reference_no"
    value="{{ old('reference_no') }}"
    class="form-control">
</div>

<div class="mb-3">
  <label class="form-label">Remarks</label>
  <textarea name="remarks"
    class="form-control">{{ old('remarks') }}</textarea>
</div>

<hr />

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Product</th>
      <th>Quantity</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input name="item[name]"
          value="{{ old('item.*.name') }}"
          class="form-control form-control-sm" /></td>
      <td>
        <input name="item[quantity]"
          value="{{ old('item.*.quantity') }}"
          class="form-control form-control-sm" />
      </td>
      <td>
        <button type="button"
          class="btn btn-sm btn-primary">+</button>
        <button type="button"
          class="btn btn-sm btn-primary">-</button>
      </td>
    </tr>
  </tbody>
</table>
