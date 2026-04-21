@extends('layouts.admin')

@section('title', 'All Orders - Admin')

@section('admin-content')
<div class="page-header">
    <h1><i class="bi bi-receipt me-2" style="color: var(--primary);"></i>All Orders</h1>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom mb-0" id="admin-orders-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="fw-bold">{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->items->count() }}</td>
                        <td class="fw-bold">Rs. {{ number_format($order->total_amount, 2) }}</td>
                        <td><span class="badge badge-status badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                        <td class="small">{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary-custom"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orders->links('pagination.bootstrap') }}</div>
@endsection
