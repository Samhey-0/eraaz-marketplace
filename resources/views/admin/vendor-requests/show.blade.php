@extends('layouts.admin')

@section('title', 'Vendor Request Details - Admin')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-shop-window me-2" style="color: var(--primary);"></i>Vendor Request Details</h1>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted small text-uppercase">Applicant</h6>
                    <p class="fw-bold mb-0">{{ $vendorRequest->user->name }}</p>
                    <small class="text-muted">{{ $vendorRequest->user->email }}</small>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted small text-uppercase">Status</h6>
                    <span class="badge badge-status badge-{{ $vendorRequest->status }} fs-6">{{ ucfirst($vendorRequest->status) }}</span>
                </div>
            </div>
            <hr>
            <div class="mb-3">
                <h6 class="text-muted small text-uppercase">Business Name</h6>
                <p class="fw-bold">{{ $vendorRequest->business_name }}</p>
            </div>
            <div class="mb-3">
                <h6 class="text-muted small text-uppercase">Business Description</h6>
                <p>{{ $vendorRequest->business_description }}</p>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted small text-uppercase">Phone</h6>
                    <p>{{ $vendorRequest->phone }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted small text-uppercase">Address</h6>
                    <p>{{ $vendorRequest->address }}</p>
                </div>
            </div>
            <div class="mb-3">
                <h6 class="text-muted small text-uppercase">Submitted</h6>
                <p>{{ $vendorRequest->created_at->format('F d, Y h:i A') }}</p>
            </div>
            @if($vendorRequest->admin_note)
                <div class="mb-3">
                    <h6 class="text-muted small text-uppercase">Admin Note</h6>
                    <p>{{ $vendorRequest->admin_note }}</p>
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        @if($vendorRequest->status === 'pending')
            <div class="card-custom p-4 mb-3">
                <h5 class="fw-bold mb-3">Actions</h5>
                <form action="{{ route('admin.vendor-requests.approve', $vendorRequest) }}" method="POST" class="mb-2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success-custom w-100" onclick="return confirm('Approve this vendor?')" id="approve-vendor-btn">
                        <i class="bi bi-check-circle me-1"></i> Approve
                    </button>
                </form>
                <form action="{{ route('admin.vendor-requests.reject', $vendorRequest) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-2">
                        <label class="form-label small">Rejection Note (optional)</label>
                        <textarea name="admin_note" class="form-control" rows="2" id="reject-note"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger-custom w-100" onclick="return confirm('Reject this vendor?')" id="reject-vendor-btn">
                        <i class="bi bi-x-circle me-1"></i> Reject
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

<a href="{{ route('admin.vendor-requests.index') }}" class="btn btn-secondary-custom mt-3"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection
