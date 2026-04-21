@extends('layouts.admin')

@section('title', 'Manage Products - Admin')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-box-seam me-2" style="color: var(--primary);"></i>All Products</h1>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom mb-0" id="admin-products-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Vendor</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr id="admin-product-{{ $product->id }}">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;" alt="">
                                @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="bi bi-image text-muted small"></i></div>
                                @endif
                                <strong class="small">{{ Str::limit($product->name, 30) }}</strong>
                            </div>
                        </td>
                        <td class="small">{{ $product->vendor->name }}</td>
                        <td><span class="badge bg-light text-dark">{{ $product->category->name }}</span></td>
                        <td class="fw-bold">Rs. {{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <span class="badge badge-status {{ $product->is_active ? 'badge-approved' : 'badge-rejected' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.products.toggle', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $product->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $product->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="bi {{ $product->is_active ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $products->links('pagination.bootstrap') }}</div>
@endsection
