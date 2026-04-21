@extends('layouts.main')

@section('title', 'My Dashboard - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h1><i class="bi bi-speedometer2 me-2" style="color: var(--primary);"></i>My Dashboard</h1>
        <p>Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="stat-card purple">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon"><i class="bi bi-receipt"></i></div>
                    <div>
                        <div class="stat-number">{{ $totalOrders }}</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="stat-card amber">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon"><i class="bi bi-clock"></i></div>
                    <div>
                        <div class="stat-number">{{ $pendingOrders }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="stat-card green">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
                    <div>
                        <div class="stat-number">{{ $deliveredOrders }}</div>
                        <div class="stat-label">Delivered</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="stat-card blue">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon"><i class="bi bi-wallet2"></i></div>
                    <div>
                        <div class="stat-number">Rs. {{ number_format($totalSpent, 2) }}</div>
                        <div class="stat-label">Total Spent</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Orders -->
        <div class="col-lg-8">
            <div class="card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Recent Orders</h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary-custom">View All</a>
                </div>

                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-custom mb-0" id="customer-orders-table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td><a href="{{ route('orders.show', $order) }}" class="text-decoration-none fw-bold">{{ $order->order_number }}</a></td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="fw-bold">Rs. {{ number_format($order->total_amount, 2) }}</td>
                                        <td><span class="badge badge-status badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-receipt d-block fs-3 mb-2"></i>
                        No orders yet. <a href="{{ route('products.index') }}">Start shopping!</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Vendor Application -->
        <div class="col-lg-4">
            <div class="card-custom p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-shop-window me-2"></i>Become a Vendor</h5>

                @if($vendorRequest)
                    <div class="text-center py-3">
                        <span class="badge badge-status badge-{{ $vendorRequest->status }} fs-6 mb-2">{{ ucfirst($vendorRequest->status) }}</span>
                        <p class="text-muted small">
                            @if($vendorRequest->status === 'pending')
                                Your application is under review.
                            @elseif($vendorRequest->status === 'approved')
                                Congratulations! You are now a vendor.
                            @else
                                Your application was rejected.
                                @if($vendorRequest->admin_note)
                                    <br><strong>Reason:</strong> {{ $vendorRequest->admin_note }}
                                @endif
                            @endif
                        </p>
                    </div>
                @else
                    <p class="text-muted small">Want to sell products on our marketplace? Apply to become a vendor!</p>
                    <a href="{{ route('vendor.request.create') }}" class="btn btn-primary-custom w-100" id="apply-vendor-btn">
                        <i class="bi bi-send me-2"></i>Apply Now
                    </a>
                @endif
            </div>

            <div class="card-custom p-4 mt-3">
                <h5 class="fw-bold mb-3"><i class="bi bi-lightning me-2"></i>Quick Links</h5>
                <a href="{{ route('products.index') }}" class="d-block text-decoration-none py-2 border-bottom">
                    <i class="bi bi-grid me-2" style="color: var(--primary);"></i>Browse Products
                </a>
                <a href="{{ route('cart.index') }}" class="d-block text-decoration-none py-2 border-bottom">
                    <i class="bi bi-bag me-2" style="color: var(--primary);"></i>My Cart
                </a>
                <a href="{{ route('orders.index') }}" class="d-block text-decoration-none py-2">
                    <i class="bi bi-receipt me-2" style="color: var(--primary);"></i>Order History
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
