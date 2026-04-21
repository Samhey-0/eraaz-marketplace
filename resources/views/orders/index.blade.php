@extends('layouts.main')

@section('title', 'My Orders - Eraaz Marketplace')

@section('content')
<div class="container py-4">
    <div class="page-header">
        <h1><i class="bi bi-receipt me-2" style="color: var(--primary);"></i>My Orders</h1>
    </div>

    @if($orders->count() > 0)
        <div class="card-custom">
            <div class="table-responsive">
                <table class="table table-custom mb-0" id="orders-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr id="order-row-{{ $order->id }}">
                                <td class="fw-bold">{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>{{ $order->items->count() }} items</td>
                                <td class="fw-bold">Rs. {{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge badge-status badge-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary-custom">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $orders->links('pagination.bootstrap') }}
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-receipt d-block"></i>
            <h5>No orders yet</h5>
            <p>You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary-custom">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
