@extends('layouts.main')

@section('title', 'Eraaz Marketplace - Shop from Multiple Vendors')

@section('content')
<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="mb-3 animate-fade-in">Discover Amazing<br>Products from<br>Trusted Vendors</h1>
                <p class="mb-4 animate-fade-in" style="animation-delay: 0.1s;">Your one-stop marketplace with hundreds of quality products from verified vendors. Shop with confidence, enjoy secure checkout and fast delivery.</p>
                <div class="d-flex gap-3 animate-fade-in" style="animation-delay: 0.2s;">
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-4 fw-bold" id="hero-shop-btn">
                        <i class="bi bi-bag me-2"></i>Shop Now
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4" id="hero-register-btn">
                            Start Selling
                        </a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center animate-fade-in" style="animation-delay: 0.3s;">
                <div class="hero-logo-container">
                    <img src="{{ asset('images/logo.png') }}" alt="Eraaz Marketplace Engine" class="img-fluid floating-logo" style="max-height: 350px; border-radius: 40px; box-shadow: 0 30px 60px rgba(0,0,0,0.3);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
@if($categories->count() > 0)
<section class="py-5" id="categories-section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Shop by Category</h2>
            <p class="text-muted">Browse our curated categories</p>
        </div>
        <div class="row g-3">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-decoration-none" id="cat-{{ $category->slug }}">
                        <div class="card-custom text-center p-3">
                            <i class="bi bi-tag fs-2 d-block mb-2" style="color: var(--primary);"></i>
                            <h6 class="mb-1 text-dark fw-bold" style="font-size: 0.85rem;">{{ $category->name }}</h6>
                            <small class="text-muted">{{ $category->products_count }} products</small>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Featured Products -->
<section class="py-5" id="featured-products">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Latest Products</h2>
                <p class="text-muted mb-0">Fresh arrivals from our vendors</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-secondary-custom" id="view-all-btn">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="product-card card h-100" id="product-{{ $product->id }}">
                            <div class="image-wrapper">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                                @else
                                    <div class="product-image d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                <span class="category-badge">{{ $product->category->name }}</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold mb-1">{{ Str::limit($product->name, 40) }}</h6>
                                <p class="text-muted small mb-2">by {{ $product->vendor->name }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="price">Rs. {{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary-custom btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-box-seam d-block"></i>
                <h5>No products yet</h5>
                <p>Products will appear here once vendors start listing them.</p>
            </div>
        @endif
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-white" id="why-choose">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose Eraaz?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background: rgba(99,102,241,0.1);">
                        <i class="bi bi-shield-check fs-3" style="color: var(--primary);"></i>
                    </div>
                    <h5 class="fw-bold">Trusted Vendors</h5>
                    <p class="text-muted small">All our vendors are verified and approved to ensure quality products.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background: rgba(16,185,129,0.1);">
                        <i class="bi bi-truck fs-3" style="color: var(--success);"></i>
                    </div>
                    <h5 class="fw-bold">Fast Delivery</h5>
                    <p class="text-muted small">Track your orders in real-time with multiple delivery status updates.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background: rgba(245,158,11,0.1);">
                        <i class="bi bi-lock fs-3" style="color: var(--accent);"></i>
                    </div>
                    <h5 class="fw-bold">Secure Shopping</h5>
                    <p class="text-muted small">Your data and transactions are protected with enterprise-grade security.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
