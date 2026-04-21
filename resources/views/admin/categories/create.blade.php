@extends('layouts.admin')

@section('title', 'Add Category - Admin')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2" style="color: var(--primary);"></i>Add Category</h1>
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

            <form action="{{ route('admin.categories.store') }}" method="POST" id="create-category-form">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required id="cat-name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" id="cat-desc">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked id="cat-active">
                        <label class="form-check-label" for="cat-active">Active</label>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom" id="save-category-btn">
                        <i class="bi bi-check-circle me-1"></i> Save Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary-custom">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
