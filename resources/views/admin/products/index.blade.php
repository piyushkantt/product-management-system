@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Products</h3>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.create') }}"
           class="btn btn-primary">
            Add Product
        </a>
    </div>
</div>

{{-- TABLE --}}
@if($products->count())
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th width="170">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $product->name }}</td>

                            <td>{{ $product->category }}</td>

                            <td>₹ {{ number_format($product->price, 2) }}</td>

                            <td class="text-center">
                                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>

                            <td class="text-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         width="50"
                                         height="50"
                                         class="rounded border"
                                         alt="Product Image">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.products.destroy', $product) }}"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>

@else
    <div class="alert alert-info text-center">
        No products found.
    </div>
@endif

@endsection
