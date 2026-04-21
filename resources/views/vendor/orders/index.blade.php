@extends('layouts.vendor')

@section('title', 'Orders - Vendor')

@section('vendor-content')
<div class="page-header">
    <h1><i class="bi bi-receipt me-2" style="color: var(--primary);"></i>Orders</h1>
    <p>Manage orders for your products</p>
</div>

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom mb-0" id="vendor-orders-table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orderItems as $item)
                    <tr id="vendor-order-{{ $item->id }}">
                        <td class="fw-bold small">{{ $item->order->order_number }}</td>
                        <td class="small">{{ Str::limit($item->product_name, 25) }}</td>
                        <td class="small">{{ $item->order->user->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="fw-bold">Rs. {{ number_format($item->subtotal, 2) }}</td>
                        <td><span class="badge badge-status badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
                        <td class="small">{{ $item->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('vendor.orders.show', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                <form action="{{ route('vendor.orders.update-status', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm d-inline" style="width: auto;" onchange="this.form.submit()" id="status-{{ $item->id }}">
                                        <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $item->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $item->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $item->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orderItems->links('pagination.bootstrap') }}</div>
@endsection
