@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Product</h5>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.products.update', $product) }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Product Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name"
                               class="form-control"
                               value="{{ old('name', $product->name) }}">
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category"
                               class="form-control"
                               value="{{ old('category', $product->category) }}">
                    </div>

                    <!-- Price -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price"
                               class="form-control"
                               value="{{ old('price', $product->price) }}">
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock"
                               class="form-control"
                               value="{{ old('stock', $product->stock) }}">
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Replace Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <!-- Buttons -->
           <div class="d-flex justify-content-end gap-2 mt-3">
    <button type="submit" class="btn btn-primary">
        Update Product
    </button>

    <a href="{{ route('admin.products.index') }}"
       class="btn btn-secondary">
        Cancel
    </a>
</div>
            </form>
        </div>
    </div>
</div>
@endsection
