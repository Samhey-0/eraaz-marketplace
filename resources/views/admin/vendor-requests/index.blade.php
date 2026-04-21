@extends('layouts.admin')

@section('title', 'Vendor Requests - Admin')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-shop-window me-2" style="color: var(--primary);"></i>Vendor Requests</h1>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom mb-0" id="vendor-requests-table">
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Business Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr id="vendor-req-{{ $request->id }}">
                        <td>
                            <strong class="small">{{ $request->user->name }}</strong>
                            <br><small class="text-muted">{{ $request->user->email }}</small>
                        </td>
                        <td class="fw-bold">{{ $request->business_name }}</td>
                        <td class="small">{{ $request->phone }}</td>
                        <td>
                            <span class="badge badge-status badge-{{ $request->status === 'approved' ? 'approved' : ($request->status === 'rejected' ? 'rejected' : 'pending') }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td class="small">{{ $request->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.vendor-requests.show', $request) }}" class="btn btn-sm btn-primary-custom"><i class="bi bi-eye"></i></a>
                            @if($request->status === 'pending')
                                <form action="{{ route('admin.vendor-requests.approve', $request) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success-custom" onclick="return confirm('Approve this vendor?')"><i class="bi bi-check-lg"></i></button>
                                </form>
                                <form action="{{ route('admin.vendor-requests.reject', $request) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger-custom" onclick="return confirm('Reject this vendor?')"><i class="bi bi-x-lg"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No vendor requests found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $requests->links('pagination.bootstrap') }}</div>
@endsection
