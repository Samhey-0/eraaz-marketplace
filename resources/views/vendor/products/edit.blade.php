@extends('layouts.vendor')

@section('title', 'Edit Product - Vendor')

@section('vendor-content')
<div class="page-header">
    <h1><i class="bi bi-pencil me-2" style="color: var(--primary);"></i>Edit Product</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            @if($errors->any())
                <div class="alert alert-danger alert-custom mb-3">
                    @foreach ($errors->all() as $error)
                        <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('vendor.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="edit-product-form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required id="prod-name-edit">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="4" required id="prod-desc-edit">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Price (PKR) *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" min="0.01" required id="prod-price-edit">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Stock *</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required id="prod-stock-edit">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select" required id="prod-category-edit">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Product Image</label>
                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*" id="prod-image-edit">
                    <small class="text-muted">Leave empty to keep current image. Max 2MB.</small>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom" id="update-product-btn">
                        <i class="bi bi-check-circle me-1"></i> Update Product
                    </button>
                    <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary-custom">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
