@extends('layouts.app')

@section('content')
<h3 class="mb-3">Add Product</h3>

<form method="POST"
      action="{{ route('admin.products.store') }}"
      enctype="multipart/form-data"
      class="card p-4">

    @csrf

    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <input type="text" name="category" class="form-control" value="{{ old('category') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Image (optional)</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success">Create Product</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</form>
@endsection
