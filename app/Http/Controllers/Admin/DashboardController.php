<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorRequest;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with stats.
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::sum('total_amount');
        $totalCommissionsEarned = \App\Models\VendorEarning::sum('admin_commission');
        $pendingVendorRequests = VendorRequest::where('status', 'pending')->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalVendors',
            'totalOrders',
            'totalProducts',
            'totalRevenue',
            'totalCommissionsEarned',
            'pendingVendorRequests',
            'recentOrders',
            'recentUsers'
        ));
    }
}
