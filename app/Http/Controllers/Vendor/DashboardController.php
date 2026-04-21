<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    /**
     * Display the vendor dashboard.
     */
    public function index()
    {
        $vendorId = auth()->id();
        $totalProducts = auth()->user()->products()->count();
        $activeProducts = auth()->user()->products()->where('is_active', true)->count();
        $totalOrderItems = OrderItem::where('vendor_id', $vendorId)->count();
        $pendingOrders = OrderItem::where('vendor_id', $vendorId)->where('status', 'pending')->count();
        $totalRevenue = OrderItem::where('vendor_id', $vendorId)->sum('subtotal');
        $recentOrderItems = OrderItem::where('vendor_id', $vendorId)
            ->with(['order.user', 'product'])
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'totalOrderItems',
            'pendingOrders',
            'totalRevenue',
            'recentOrderItems'
        ));
    }
}
