@extends('layouts.vendor')

@section('title', 'Order Detail - Vendor')

@section('vendor-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Order #{{ $orderItem->order->order_number }}</h4>
        <small class="text-muted">Customer: {{ $orderItem->order->user->name }} · {{ $orderItem->created_at->format('F d, Y h:i A') }}</small>
    </div>
    <span class="badge badge-status badge-{{ $orderItem->status }} fs-6">{{ ucfirst($orderItem->status) }}</span>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <h5 class="fw-bold mb-3">Order Item Details</h5>
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                <div>
                    <h6 class="fw-bold mb-0">{{ $orderItem->product_name }}</h6>
                    <small class="text-muted">Quantity: {{ $orderItem->quantity }} × Rs. {{ number_format($orderItem->price, 2) }}</small>
                </div>
                <div class="fw-bold fs-5" style="color: var(--primary);">Rs. {{ number_format($orderItem->subtotal, 2) }}</div>
            </div>

            <h6 class="fw-bold mt-4 mb-3">Shipping Information</h6>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>{{ $orderItem->order->shipping_name }}</strong></p>
                    <p class="mb-1 text-muted">{{ $orderItem->order->shipping_email }}</p>
                    <p class="mb-1 text-muted">{{ $orderItem->order->shipping_phone }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted">{{ $orderItem->order->shipping_address }}</p>
                    <p class="mb-1 text-muted">{{ $orderItem->order->shipping_city }}, {{ $orderItem->order->shipping_zip }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-custom p-4">
            <h5 class="fw-bold mb-3">Update Status</h5>
            <form action="{{ route('vendor.orders.update-status', $orderItem) }}" method="POST" id="update-order-status-form">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select mb-3" id="order-status-select">
                    <option value="pending" {{ $orderItem->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $orderItem->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $orderItem->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $orderItem->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                <button type="submit" class="btn btn-primary-custom w-100" id="update-status-btn">
                    <i class="bi bi-check-circle me-1"></i> Update Status
                </button>
            </form>
        </div>
    </div>
</div>

<a href="{{ route('vendor.orders.index') }}" class="btn btn-secondary-custom mt-3"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection
