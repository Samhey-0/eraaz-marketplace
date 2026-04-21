@extends('layouts.admin')

@section('title', 'Users - Admin')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-people me-2" style="color: var(--primary);"></i>All Users</h1>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom mb-0" id="admin-users-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td class="text-muted small">{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-status {{ $user->role === 'admin' ? 'badge-shipped' : ($user->role === 'vendor' ? 'badge-processing' : 'badge-pending') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="small">{{ $user->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $users->links('pagination.bootstrap') }}</div>
@endsection
