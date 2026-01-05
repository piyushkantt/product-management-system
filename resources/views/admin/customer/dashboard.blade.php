@extends('layouts.app')

@section('content')
<h4 class="mb-3">Products</h4>

@if($products->count())
    <div class="row g-4">

        @foreach($products as $product)
            <div class="col-md-4 col-sm-6">

                <div class="card h-100 shadow-sm">
  <img
    src="{{ $product->image 
        ? asset('products/' . $product->image) 
        : asset('images/default.png') }}"
    class="card-img-top"
    style="height: 180px; object-fit: cover;"
    alt="{{ $product->name }}"
    loading="lazy"
/>





                    <div class="card-body d-flex flex-column">

                        <h6 class="card-title">
                            {{ $product->name }}
                        </h6>

                        <p class="text-muted small mb-1">
                            {{ $product->category }}
                        </p>

                        <p class="fw-bold mb-2">
                            ₹ {{ number_format($product->price, 2) }}
                        </p>

                        <span class="badge 
                            {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}
                            mb-3
                        ">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>

                        <button class="btn btn-outline-primary mt-auto" disabled>
                            View Details
                        </button>
                    </div>

                </div>

            </div>
        @endforeach

    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@else
    <div class="alert alert-info">
        No products available.
    </div>
@endif
@endsection
