@extends('layouts.vendor')

@section('title', 'Earnings & Payouts - Eraaz Vendor')

@section('vendor-content')
<div class="page-header">
    <h1><i class="bi bi-wallet2 me-2" style="color: var(--primary);"></i>Earnings & Payouts</h1>
    <p>Manage your revenue, see your pending earnings, and track payouts.</p>
</div>

<!-- Financial Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card green border border-green border-opacity-25" style="background: rgba(34, 197, 94, 0.05);">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon text-success"><i class="bi bi-cash-stack"></i></div>
                <div>
                    <div class="stat-number text-success">Rs. {{ number_format($availablePayout, 2) }}</div>
                    <div class="stat-label">Available for Payout</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card amber border border-warning border-opacity-25" style="background: rgba(245, 158, 11, 0.05);">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon text-warning"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <div class="stat-number text-warning">Rs. {{ number_format($pendingClearance, 2) }}</div>
                    <div class="stat-label">Pending Clearance</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card blue">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                <div>
                    <div class="stat-number">Rs. {{ number_format($totalEarned, 2) }}</div>
                    <div class="stat-label">Total Lifetime Earned</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card purple">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
                <div>
                    <div class="stat-number">Rs. {{ number_format($totalPaidOut, 2) }}</div>
                    <div class="stat-label">Total Paid Out</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Payout History -->
    <div class="col-lg-4">
        <div class="card-custom p-4 h-100">
            <h5 class="fw-bold mb-3 d-flex align-items-center"><i class="bi bi-bank2 me-2 text-primary"></i>Recent Payouts</h5>
            @if($payouts->count() > 0)
                <div class="d-flex flex-column gap-3">
                    @foreach($payouts as $payout)
                        <div class="p-3 border rounded bg-light" style="background: var(--bg-card) !important; border-color: rgba(255,255,255,0.1) !important;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold fs-5 text-success">+Rs. {{ number_format($payout->amount, 2) }}</span>
                                <span class="badge badge-status badge-{{ $payout->status }}">{{ ucfirst($payout->status) }}</span>
                            </div>
                            <div class="text-muted small mb-1"><i class="bi bi-credit-card me-1"></i>{{ $payout->payment_method ?? 'Bank Transfer' }}</div>
                            <div class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ $payout->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    {{ $payouts->links() }}
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-journal-x fs-1 opacity-50 mb-2"></i>
                    <p>No payouts received yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Earnings Breakdown -->
    <div class="col-lg-8">
        <div class="card-custom p-4 h-100">
            <h5 class="fw-bold mb-3 d-flex align-items-center"><i class="bi bi-list-columns me-2 text-primary"></i>Earnings per Order</h5>
            @if($earnings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Sales amount</th>
                                <th>Platform Fee</th>
                                <th>Your Earning</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($earnings as $earning)
                                <tr>
                                    <td><a href="{{ route('vendor.orders.show', $earning->order_id) }}" class="fw-bold text-decoration-none">#{{ $earning->order->order_number ?? 'N/A' }}</a></td>
                                    <td>{{ $earning->created_at->format('M d, Y') }}</td>
                                    <td>Rs. {{ number_format($earning->total_sales, 2) }}</td>
                                    <td class="text-danger">-Rs. {{ number_format($earning->admin_commission, 2) }}</td>
                                    <td class="fw-bold text-success">Rs. {{ number_format($earning->vendor_earning, 2) }}</td>
                                    <td>
                                        @if($earning->status === 'pending')
                                            <span class="badge badge-status badge-pending">Pending</span>
                                        @elseif($earning->status === 'available')
                                            <span class="badge badge-status badge-processing">Available</span>
                                        @else
                                            <span class="badge badge-status badge-shipped">Paid</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $earnings->links() }}
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-cart-x fs-1 opacity-50 mb-2"></i>
                    <p>No earnings recorded yet. Once an order is placed for your products, it will appear here!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
