@extends('layouts.vendor')

@section('title', 'My Products - Vendor')

@section('vendor-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="page-header mb-0">
        <h1 class="mb-0"><i class="bi bi-box-seam me-2" style="color: var(--primary);"></i>My Products</h1>
    </div>
    <a href="{{ route('vendor.products.create') }}" class="btn btn-primary-custom" id="vendor-add-product-btn">
        <i class="bi bi-plus-circle me-1"></i> Add Product
    </a>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom mb-0" id="vendor-products-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr id="vendor-product-{{ $product->id }}">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;" alt="">
                                @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="bi bi-image text-muted small"></i></div>
                                @endif
                                <strong class="small">{{ Str::limit($product->name, 35) }}</strong>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark">{{ $product->category->name }}</span></td>
                        <td class="fw-bold">Rs. {{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">{{ $product->stock }}</span>
                        </td>
                        <td>
                            <span class="badge badge-status {{ $product->is_active ? 'badge-approved' : 'badge-rejected' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('vendor.products.edit', $product) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No products yet. <a href="{{ route('vendor.products.create') }}">Add your first product!</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $products->links('pagination.bootstrap') }}</div>
@endsection
