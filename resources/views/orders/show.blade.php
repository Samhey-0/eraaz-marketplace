@extends('layouts.main')

@section('title', 'Order #' . $order->order_number . ' - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Order #{{ $order->order_number }}</h4>
            <small class="text-muted">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</small>
        </div>
        <span class="badge badge-status badge-{{ $order->status }} fs-6">{{ ucfirst($order->status) }}</span>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-custom p-4 mb-4" id="order-items-card">
                <h5 class="fw-bold mb-3">Order Items</h5>
                @foreach($order->items as $item)
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            @if($item->product && $item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <h6 class="fw-bold mb-0">{{ $item->product_name }}</h6>
                                <small class="text-muted">by {{ $item->vendor->name ?? 'N/A' }} · Qty: {{ $item->quantity }}</small>
                                <br>
                                <span class="badge badge-status badge-{{ $item->status }} mt-1">{{ ucfirst($item->status) }}</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="text-muted small">Rs. {{ number_format($item->price, 2) }} × {{ $item->quantity }}</div>
                            <div class="fw-bold" style="color: var(--primary);">Rs. {{ number_format($item->subtotal, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-custom p-4 mb-4" id="order-summary-card">
                <h5 class="fw-bold mb-3">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Shipping</span>
                    <span class="text-success">Free</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5" style="color: var(--primary);">Rs. {{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            <div class="card-custom p-4" id="shipping-info-card">
                <h5 class="fw-bold mb-3"><i class="bi bi-truck me-2"></i>Shipping Info</h5>
                <p class="mb-1"><strong>{{ $order->shipping_name }}</strong></p>
                <p class="mb-1 text-muted">{{ $order->shipping_email }}</p>
                <p class="mb-1 text-muted">{{ $order->shipping_phone }}</p>
                <p class="mb-1 text-muted">{{ $order->shipping_address }}</p>
                <p class="mb-0 text-muted">{{ $order->shipping_city }}, {{ $order->shipping_zip }}</p>
                @if($order->notes)
                    <hr>
                    <p class="mb-0 small"><strong>Notes:</strong> {{ $order->notes }}</p>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary-custom mt-3">
        <i class="bi bi-arrow-left me-1"></i> Back to Orders
    </a>
</div>
@endsection
