@extends('layouts.admin')

@section('title', 'Manage Vendor Payouts - Eraaz Marketplace')

@section('admin-content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-wallet2 me-2" style="color: var(--primary);"></i>Payouts Management</h1>
            <p>Review vendor balances and process payments</p>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-octagon me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card-custom p-4 mb-4">
    <h5 class="fw-bold mb-3">Vendor Balances</h5>
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th>Vendor Name</th>
                    <th>Pending Clearance</th>
                    <th>Available for Payout</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vendors as $vendor)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    {{ strtoupper(substr($vendor->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $vendor->name }}</div>
                                    <div class="small text-muted">{{ $vendor->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-warning fw-medium">
                            <i class="bi bi-hourglass-split me-1"></i>Rs. {{ number_format($vendor->pending_earnings ?? 0, 2) }}
                        </td>
                        <td class="text-success fw-bold">
                            <i class="bi bi-cash me-1"></i>Rs. {{ number_format($vendor->available_earnings ?? 0, 2) }}
                        </td>
                        <td>
                            @if(($vendor->available_earnings ?? 0) > 0)
                                <form action="{{ route('admin.payouts.process', $vendor) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to mark Rs. {{ number_format($vendor->available_earnings, 2) }} as paid out for {{ $vendor->name }}?');">
                                    @csrf
                                    <button class="btn btn-sm btn-primary-custom" type="submit">
                                        <i class="bi bi-currency-dollar me-1"></i> Pay Now
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-secondary-custom disabled opacity-50" type="button" disabled>
                                    Nothing to pay
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No vendors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $vendors->links() }}
    </div>
</div>

<div class="card-custom p-4">
    <h5 class="fw-bold mb-3">Global Payout History</h5>
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th>Vendor</th>
                    <th>Amount Paid</th>
                    <th>Method</th>
                    <th>Date Paid</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payouts as $pout)
                    <tr>
                        <td class="fw-bold">{{ $pout->vendor->name ?? 'Unknown Vendor' }}</td>
                        <td class="text-success fw-bold">Rs. {{ number_format($pout->amount, 2) }}</td>
                        <td>{{ $pout->payment_method ?? 'System' }}</td>
                        <td>{{ $pout->created_at->format('M d, Y h:i A') }}</td>
                        <td>
                            <span class="badge badge-status badge-{{ $pout->status === 'completed' ? 'shipped' : 'pending' }}">
                                {{ ucfirst($pout->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No payouts processed yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $payouts->links() }}
    </div>
</div>
@endsection
