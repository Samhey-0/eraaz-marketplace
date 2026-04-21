@extends('layouts.main')

@section('title', 'Apply as Vendor - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="page-header text-center">
                <h1><i class="bi bi-shop-window me-2" style="color: var(--primary);"></i>Become a Vendor</h1>
                <p>Fill out the form below to apply as a vendor on Eraaz Marketplace.</p>
            </div>

            @if($existingRequest)
                <div class="card-custom p-4 text-center">
                    <h5 class="fw-bold mb-3">Application Status</h5>
                    <span class="badge badge-status badge-{{ $existingRequest->status }} fs-5 mb-3">{{ ucfirst($existingRequest->status) }}</span>

                    @if($existingRequest->status === 'pending')
                        <p class="text-muted">Your application is currently under review. We'll notify you once it's processed.</p>
                    @elseif($existingRequest->status === 'approved')
                        <p class="text-success">Your application has been approved! You can now access the vendor dashboard.</p>
                        <a href="{{ route('vendor.dashboard') }}" class="btn btn-primary-custom">Go to Vendor Dashboard</a>
                    @else
                        <p class="text-danger">Unfortunately, your application was rejected.</p>
                        @if($existingRequest->admin_note)
                            <p class="text-muted"><strong>Reason:</strong> {{ $existingRequest->admin_note }}</p>
                        @endif
                    @endif
                </div>
            @else
                <div class="card-custom p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-custom mb-3">
                            @foreach ($errors->all() as $error)
                                <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('vendor.request.store') }}" method="POST" id="vendor-request-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Business Name *</label>
                            <input type="text" name="business_name" class="form-control" value="{{ old('business_name') }}" required placeholder="Your store/business name" id="biz-name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Description *</label>
                            <textarea name="business_description" class="form-control" rows="4" required placeholder="Tell us about your business, products you want to sell..." id="biz-desc">{{ old('business_description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required placeholder="+1 234 567 8900" id="biz-phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Address *</label>
                            <textarea name="address" class="form-control" rows="2" required placeholder="Your business address" id="biz-address">{{ old('address') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 py-2" id="submit-vendor-btn">
                            <i class="bi bi-send me-2"></i>Submit Application
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
