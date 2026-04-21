@extends('layouts.admin')

@section('title', 'Edit Category - Admin')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-pencil me-2" style="color: var(--primary);"></i>Edit Category</h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card-custom p-4">
            @if($errors->any())
                <div class="alert alert-danger alert-custom mb-3">
                    @foreach ($errors->all() as $error)
                        <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="edit-category-form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required id="cat-name-edit">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" id="cat-desc-edit">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }} id="cat-active-edit">
                        <label class="form-check-label" for="cat-active-edit">Active</label>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom" id="update-category-btn">
                        <i class="bi bi-check-circle me-1"></i> Update Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary-custom">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
