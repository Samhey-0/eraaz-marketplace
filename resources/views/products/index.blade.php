@extends('layouts.main')

@section('title', 'Shop - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 mb-4">
            <div class="card-custom p-3">
                <h6 class="fw-bold mb-3"><i class="bi bi-funnel me-2"></i>Filters</h6>

                <!-- Categories -->
                <div class="mb-4">
                    <h6 class="fw-bold text-muted small text-uppercase mb-2">Categories</h6>
                    <a href="{{ route('products.index', request()->except('category')) }}" class="d-block text-decoration-none py-1 small {{ !request('category') ? 'fw-bold' : '' }}" style="color: var(--text-primary);" id="filter-all">
                        All Categories
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', array_merge(request()->all(), ['category' => $category->slug])) }}"
                           class="d-block text-decoration-none py-1 small {{ request('category') == $category->slug ? 'fw-bold' : '' }}"
                           style="color: var(--text-primary);"
                           id="filter-{{ $category->slug }}">
                            {{ $category->name }} <span class="text-muted">({{ $category->products_count }})</span>
                        </a>
                    @endforeach
                </div>

                <!-- Sort -->
                <div>
                    <h6 class="fw-bold text-muted small text-uppercase mb-2">Sort By</h6>
                    <select class="form-select form-select-sm" onchange="window.location.href=this.value" id="sort-select">
                        <option value="{{ route('products.index', array_merge(request()->all(), ['sort' => 'latest'])) }}" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="{{ route('products.index', array_merge(request()->all(), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="{{ route('products.index', array_merge(request()->all(), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="{{ route('products.index', array_merge(request()->all(), ['sort' => 'name'])) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold mb-0">
                        @if(request('q'))
                            Search: "{{ request('q') }}"
                        @elseif(request('category'))
                            {{ $categories->firstWhere('slug', request('category'))?->name ?? 'Products' }}
                        @else
                            All Products
                        @endif
                    </h4>
                    <small class="text-muted">{{ $products->total() }} products found</small>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="row g-3">
                    @foreach($products as $product)
                        <div class="col-sm-6 col-md-4">
                            <div class="product-card card h-100" id="shop-product-{{ $product->id }}">
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
                                    <h6 class="fw-bold mb-1">{{ Str::limit($product->name, 35) }}</h6>
                                    <p class="text-muted small mb-2">by {{ $product->vendor->name }}</p>
                                    <p class="text-muted small mb-2">{{ Str::limit($product->description, 60) }}</p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="price">Rs. {{ number_format($product->price, 2) }}</span>
                                            <span class="small {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                            </span>
                                        </div>
                                        <div class="d-flex gap-2 mt-2">
                                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-secondary-custom btn-sm flex-fill">
                                                <i class="bi bi-eye me-1"></i>View
                                            </a>
                                            @auth
                                                @if($product->stock > 0)
                                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary-custom btn-sm">
                                                            <i class="bi bi-bag-plus"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $products->withQueryString()->links('pagination.bootstrap') }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-search d-block"></i>
                    <h5>No products found</h5>
                    <p>Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary-custom">View All Products</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
