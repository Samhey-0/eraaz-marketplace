@extends('layouts.admin')

@section('title', 'Manage Categories - Admin')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="page-header mb-0">
        <h1 class="mb-0"><i class="bi bi-tags me-2" style="color: var(--primary);"></i>Categories</h1>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary-custom" id="add-category-btn">
        <i class="bi bi-plus-circle me-1"></i> Add Category
    </a>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom mb-0" id="categories-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr id="cat-row-{{ $category->id }}">
                        <td>{{ $category->id }}</td>
                        <td class="fw-bold">{{ $category->name }}</td>
                        <td class="text-muted small">{{ $category->slug }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            <span class="badge badge-status {{ $category->is_active ? 'badge-approved' : 'badge-rejected' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $categories->links('pagination.bootstrap') }}</div>
@endsection
