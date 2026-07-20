@php $product = $product ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $product?->name) }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">SKU</label>
    <input type="text" name="sku" value="{{ old('sku', $product?->sku) }}"
           class="form-control @error('sku') is-invalid @enderror">
    @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <input type="text" name="category" value="{{ old('category', $product?->category) }}" class="form-control">
</div>

<div class="mb-3">
    <label class="form-label">Unit Price</label>
    <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', $product?->unit_price) }}"
           class="form-control @error('unit_price') is-invalid @enderror">
    @error('unit_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Quantity on Hand</label>
    <input type="number" name="quantity_on_hand" value="{{ old('quantity_on_hand', $product?->quantity_on_hand) }}"
           class="form-control @error('quantity_on_hand') is-invalid @enderror">
    @error('quantity_on_hand') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Reorder Level</label>
    <input type="number" name="reorder_level" value="{{ old('reorder_level', $product?->reorder_level) }}"
           class="form-control @error('reorder_level') is-invalid @enderror">
    @error('reorder_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="active" {{ old('status', $product?->status) === 'active' ? 'selected' : '' }}>Active</option>
        <option value="discontinued" {{ old('status', $product?->status) === 'discontinued' ? 'selected' : '' }}>Discontinued</option>
    </select>
</div>
