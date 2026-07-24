@php $transactionType = $transactionType ?? null; @endphp

<div class="mb-3">
  <label class="form-label">Name</label>
  <input type="text"
    name="name"
    value="{{ old('name', $transactionType?->name) }}"
    class="form-control @error('name') is-invalid @enderror">
  @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Mode</label>
  <select id="mode"
    name="mode"
    class="form-control form-select @error('mode') is-invalid @enderror">
    <option @selected(!old('mode', $transactionType?->mode))
      value="">-</option>
    <option @selected(old('mode', $transactionType?->mode) == 'addition')
      value="addition">Addition</option>
    <option @selected(old('mode', $transactionType?->mode) == 'deduction')
      value="deduction">Deduction</option>
  </select>

  @error('mode')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description"
    class="form-control">{{ old('description', $transactionType?->description) }}</textarea>
</div>
