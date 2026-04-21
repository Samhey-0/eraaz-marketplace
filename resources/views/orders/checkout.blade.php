@extends('layouts.main')

@section('title', 'Checkout - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h1><i class="bi bi-credit-card me-2" style="color: var(--primary);"></i>Checkout</h1>
    </div>

    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
        @csrf
        <div class="row g-4">
            <!-- Shipping Info -->
            <div class="col-lg-7">
                <div class="card-custom p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-truck me-2"></i>Shipping Information</h5>

                    @if($errors->any())
                        <div class="alert alert-danger alert-custom mb-3">
                            @foreach ($errors->all() as $error)
                                <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="shipping_name" class="form-control" value="{{ old('shipping_name', auth()->user()->name) }}" required id="ship-name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" name="shipping_email" class="form-control" value="{{ old('shipping_email', auth()->user()->email) }}" required id="ship-email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" name="shipping_phone" class="form-control" value="{{ old('shipping_phone') }}" required id="ship-phone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City *</label>
                            <input type="text" name="shipping_city" class="form-control" value="{{ old('shipping_city') }}" required id="ship-city">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Address *</label>
                            <textarea name="shipping_address" class="form-control" rows="2" required id="ship-address">{{ old('shipping_address') }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ZIP Code *</label>
                            <input type="text" name="shipping_zip" class="form-control" value="{{ old('shipping_zip') }}" required id="ship-zip">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Order Notes (Optional)</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions..." id="ship-notes">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-5">
                <div class="card-custom p-4" id="checkout-summary">
                    <h5 class="fw-bold mb-3"><i class="bi bi-receipt me-2"></i>Order Summary</h5>

                    @foreach($cart->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2 py-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-image text-muted small"></i>
                                    </div>
                                @endif
                                <div>
                                    <small class="fw-bold">{{ Str::limit($item->product->name, 25) }}</small>
                                    <br><small class="text-muted">x{{ $item->quantity }}</small>
                                </div>
                            </div>
                            <span class="fw-bold small">Rs. {{ number_format($item->subtotal, 2) }}</span>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-3 mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>Rs. {{ number_format($cart->total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success">Free</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5" style="color: var(--primary);">Rs. {{ number_format($cart->total, 2) }}</span>
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 py-2 btn-lg" id="place-order-btn">
                        <i class="bi bi-check-circle me-2"></i>Place Order
                    </button>

                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2" id="back-to-cart-btn">
                        <i class="bi bi-arrow-left me-1"></i> Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
