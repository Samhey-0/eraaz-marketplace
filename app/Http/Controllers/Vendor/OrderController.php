<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display vendor's orders (order items that belong to this vendor).
     */
    public function index()
    {
        $orderItems = OrderItem::where('vendor_id', auth()->id())
            ->with(['order.user', 'product'])
            ->latest()
            ->paginate(15);

        return view('vendor.orders.index', compact('orderItems'));
    }

    /**
     * Display a specific order item.
     */
    public function show(OrderItem $orderItem)
    {
        if ($orderItem->vendor_id !== auth()->id()) {
            abort(403);
        }

        $orderItem->load(['order.user', 'product']);

        return view('vendor.orders.show', compact('orderItem'));
    }

    /**
     * Update the status of an order item.
     */
    public function updateStatus(Request $request, OrderItem $orderItem)
    {
        if ($orderItem->vendor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered',
        ]);

        $orderItem->update(['status' => $request->status]);

        // If delivered, make earnings available for payout
        if ($request->status === 'delivered') {
            \App\Models\VendorEarning::where('order_id', $orderItem->order_id)
                ->where('vendor_id', auth()->id())
                ->update(['status' => 'available']);
        }

        // Update parent order status if all items have same status
        $order = $orderItem->order;
        $allStatuses = $order->items->pluck('status')->unique();
        if ($allStatuses->count() === 1) {
            $order->update(['status' => $allStatuses->first()]);
        }

        return back()->with('success', 'Order status updated to ' . ucfirst($request->status) . '.');
    }
}
