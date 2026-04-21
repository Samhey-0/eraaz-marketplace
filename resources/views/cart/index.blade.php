@extends('layouts.main')

@section('title', 'Shopping Cart - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h1><i class="bi bi-bag me-2" style="color: var(--primary);"></i>Shopping Cart</h1>
    </div>

    @if($cart->items->count() > 0)
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-custom">
                    <div class="table-responsive">
                        <table class="table table-custom mb-0" id="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th style="width: 120px;">Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart->items as $item)
                                    <tr id="cart-item-{{ $item->id }}">
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <a href="{{ route('products.show', $item->product->slug) }}" class="fw-bold text-decoration-none text-dark">{{ Str::limit($item->product->name, 30) }}</a>
                                                    <br><small class="text-muted">by {{ $item->product->vendor->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">Rs. {{ number_format($item->price, 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex align-items-center gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control form-control-sm" style="width: 65px;" id="qty-{{ $item->id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-arrow-repeat"></i></button>
                                            </form>
                                        </td>
                                        <td class="fw-bold" style="color: var(--primary);">Rs. {{ number_format($item->subtotal, 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" id="remove-{{ $item->id }}"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary-custom" id="continue-shopping-btn">
                        <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" id="clear-cart-btn">
                            <i class="bi bi-trash me-1"></i> Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="card-custom p-4" id="cart-summary">
                    <h5 class="fw-bold mb-3">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Items ({{ $cart->item_count }})</span>
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
                    <a href="{{ route('checkout') }}" class="btn btn-primary-custom w-100 py-2" id="checkout-btn">
                        <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-bag d-block"></i>
            <h5>Your cart is empty</h5>
            <p>Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary-custom">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
