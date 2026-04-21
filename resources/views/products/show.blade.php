@extends('layouts.main')

@section('title', $product->name . ' - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" id="product-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Shop</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-decoration-none">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Product Image -->
        <div class="col-lg-5">
            <div class="card-custom overflow-hidden" id="product-image-card">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-100" alt="{{ $product->name }}" style="max-height: 450px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">
                        <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-7">
            <div class="card-custom p-4" id="product-details-card">
                <span class="badge badge-status badge-processing mb-2">{{ $product->category->name }}</span>
                <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
                <p class="text-muted mb-3">
                    <i class="bi bi-shop me-1"></i> Sold by <strong>{{ $product->vendor->name }}</strong>
                </p>

                <div class="mb-4">
                    <span class="fs-2 fw-bold" style="color: var(--primary);">Rs. {{ number_format($product->price, 2) }}</span>
                </div>

                <div class="mb-4">
                    @if($product->stock > 0)
                        <span class="badge bg-success-subtle text-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i> In Stock ({{ $product->stock }} available)
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger px-3 py-2">
                            <i class="bi bi-x-circle me-1"></i> Out of Stock
                        </span>
                    @endif
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold">Description</h6>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>

                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex gap-3 align-items-end" id="add-to-cart-form">
                            @csrf
                            <div>
                                <label class="form-label small fw-bold">Quantity</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width: 80px;" id="qty-input">
                            </div>
                            <button type="submit" class="btn btn-primary-custom btn-lg px-4" id="add-to-cart-btn">
                                <i class="bi bi-bag-plus me-2"></i>Add to Cart
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg px-4" id="login-to-buy-btn">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login to Buy
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h4 class="fw-bold mb-3">Related Products</h4>
            <div class="row g-3">
                @foreach($relatedProducts as $related)
                    <div class="col-sm-6 col-md-3">
                        <div class="product-card card h-100" id="related-{{ $related->id }}">
                            <div class="image-wrapper">
                                @if($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" class="product-image" alt="{{ $related->name }}">
                                @else
                                    <div class="product-image d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-image text-muted" style="font-size: 2.5rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold mb-1 small">{{ Str::limit($related->name, 30) }}</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price small">Rs. {{ number_format($related->price, 2) }}</span>
                                    <a href="{{ route('products.show', $related->slug) }}" class="btn btn-primary-custom btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
