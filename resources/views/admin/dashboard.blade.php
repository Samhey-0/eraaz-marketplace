@extends('layouts.admin')

@section('title', 'Admin Dashboard - Eraaz Marketplace')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2" style="color: var(--primary);"></i>Admin Dashboard</h1>
    <p>Overview of your marketplace</p>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card purple">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <div>
                    <div class="stat-number">{{ $totalUsers }}</div>
                    <div class="stat-label">Total Users</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card blue">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-shop"></i></div>
                <div>
                    <div class="stat-number">{{ $totalVendors }}</div>
                    <div class="stat-label">Total Vendors</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card amber">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-receipt"></i></div>
                <div>
                    <div class="stat-number">{{ $totalOrders }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card green">
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

<!-- Secondary Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
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
    <div class="col-md-4">
        <div class="stat-card blue">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-piggy-bank"></i></div>
                <div>
                    <div class="stat-number">Rs. {{ number_format($totalCommissionsEarned, 2) }}</div>
                    <div class="stat-label">Platform Commissions</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card amber">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <div class="stat-number">{{ $pendingVendorRequests }}</div>
                    <div class="stat-label">Pending Vendor Requests</div>
                </div>
            </div>
            @if($pendingVendorRequests > 0)
                <a href="{{ route('admin.vendor-requests.index') }}" class="btn btn-sm btn-primary-custom mt-2">Review Now</a>
            @endif
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-7">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Recent Orders</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary-custom">View All</a>
            </div>
            @if($recentOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-custom mb-0" id="admin-recent-orders">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.show', $order) }}" class="fw-bold text-decoration-none">{{ $order->order_number }}</a></td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                                    <td><span class="badge badge-status badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
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

    <!-- Recent Users -->
    <div class="col-lg-5">
        <div class="card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Recent Users</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary-custom">View All</a>
            </div>
            @foreach($recentUsers as $user)
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                    <div>
                        <strong class="small">{{ $user->name }}</strong>
                        <br><small class="text-muted">{{ $user->email }}</small>
                    </div>
                    <span class="badge badge-status badge-{{ $user->role === 'admin' ? 'shipped' : ($user->role === 'vendor' ? 'processing' : 'pending') }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
