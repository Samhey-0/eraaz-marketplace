@extends('layouts.vendor')

@section('title', 'Vendor Dashboard - Eraaz Marketplace')

@section('vendor-content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2" style="color: var(--primary);"></i>Vendor Dashboard</h1>
    <p>Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card purple">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-number">{{ $totalProducts }}</div>
                    <div class="stat-label">Total Products</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card green">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
                <div>
                    <div class="stat-number">{{ $activeProducts }}</div>
                    <div class="stat-label">Active Products</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card amber">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-receipt"></i></div>
                <div>
                    <div class="stat-number">{{ $totalOrderItems }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card blue">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
                <div>
                    <div class="stat-number">Rs. {{ number_format($totalRevenue, 2) }}</div>
                    <div class="stat-label">Total Revenue</div>
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
                <a href="{{ route('vendor.orders.index') }}" class="btn btn-sm btn-secondary-custom">View All</a>
            </div>
            @if($recentOrderItems->count() > 0)
                <div class="table-responsive">
                    <table class="table table-custom mb-0" id="vendor-recent-orders">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrderItems as $item)
                                <tr>
                                    <td><a href="{{ route('vendor.orders.show', $item) }}" class="fw-bold text-decoration-none">{{ $item->order->order_number }}</a></td>
                                    <td class="small">{{ Str::limit($item->product_name, 20) }}</td>
                                    <td class="small">{{ $item->order->user->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="fw-bold">Rs. {{ number_format($item->subtotal, 2) }}</td>
                                    <td><span class="badge badge-status badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center py-3">No orders yet.</p>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card-custom p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
            <a href="{{ route('vendor.products.create') }}" class="btn btn-primary-custom w-100 mb-2" id="quick-add-product">
                <i class="bi bi-plus-circle me-2"></i> Add New Product
            </a>
            <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary-custom w-100 mb-2" id="quick-manage-products">
                <i class="bi bi-box-seam me-2"></i> Manage Products
            </a>
            <a href="{{ route('vendor.orders.index') }}" class="btn btn-secondary-custom w-100" id="quick-view-orders">
                <i class="bi bi-receipt me-2"></i> View Orders
            </a>
        </div>

        @if($pendingOrders > 0)
            <div class="card-custom p-4 mt-3 border-start border-warning border-3">
                <h6 class="fw-bold"><i class="bi bi-exclamation-triangle text-warning me-2"></i>Pending Orders</h6>
                <p class="text-muted small mb-2">You have {{ $pendingOrders }} pending order(s) to process.</p>
                <a href="{{ route('vendor.orders.index') }}" class="btn btn-sm btn-primary-custom">Process Now</a>
            </div>
        @endif
    </div>
</div>
@endsection
