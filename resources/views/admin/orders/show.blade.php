@extends('layouts.admin')

@section('title', 'Order #' . $order->order_number . ' - Admin')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Order #{{ $order->order_number }}</h4>
        <small class="text-muted">Placed by {{ $order->user->name }} on {{ $order->created_at->format('F d, Y h:i A') }}</small>
    </div>
    <span class="badge badge-status badge-{{ $order->status }} fs-6">{{ ucfirst($order->status) }}</span>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-custom p-4">
            <h5 class="fw-bold mb-3">Order Items</h5>
            @foreach($order->items as $item)
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $item->product_name }}</h6>
                        <small class="text-muted">Vendor: {{ $item->vendor->name ?? 'N/A' }} · Qty: {{ $item->quantity }}</small>
                        <br><span class="badge badge-status badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">Rs. {{ number_format($item->price, 2) }} × {{ $item->quantity }}</div>
                        <div class="fw-bold">Rs. {{ number_format($item->subtotal, 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-custom p-4 mb-3">
            <h5 class="fw-bold mb-3">Summary</h5>
            <div class="d-flex justify-content-between mb-2"><span>Total</span><strong>Rs. {{ number_format($order->total_amount, 2) }}</strong></div>
        </div>
        <div class="card-custom p-4">
            <h5 class="fw-bold mb-3">Shipping</h5>
            <p class="mb-1"><strong>{{ $order->shipping_name }}</strong></p>
            <p class="mb-1 text-muted small">{{ $order->shipping_email }}</p>
            <p class="mb-1 text-muted small">{{ $order->shipping_phone }}</p>
            <p class="mb-1 text-muted small">{{ $order->shipping_address }}</p>
            <p class="mb-0 text-muted small">{{ $order->shipping_city }}, {{ $order->shipping_zip }}</p>
        </div>
    </div>
</div>

<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary-custom mt-3"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection
