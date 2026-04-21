@extends('layouts.vendor')

@section('title', 'Add Product - Vendor')

@section('vendor-content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2" style="color: var(--primary);"></i>Add New Product</h1>
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

            <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" id="create-product-form">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required id="prod-name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="4" required id="prod-desc">{{ old('description') }}</textarea>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Price (PKR) *</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" step="0.01" min="0.01" required id="prod-price">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Stock *</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required id="prod-stock">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select" required id="prod-category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" id="prod-image">
                    <small class="text-muted">Max 2MB. Accepted: JPEG, PNG, GIF, WebP</small>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom" id="save-product-btn">
                        <i class="bi bi-check-circle me-1"></i> Create Product
                    </button>
                    <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary-custom">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
