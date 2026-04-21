<?php

namespace App\Http\Controllers;

use App\Models\Order;

class CustomerController extends Controller
{
    /**
     * Display the customer dashboard.
     */
    public function dashboard()
    {
        $user = auth()->user();
        $recentOrders = $user->orders()->with('items')->latest()->take(5)->get();
        $totalOrders = $user->orders()->count();
        $pendingOrders = $user->orders()->where('status', 'pending')->count();
        $deliveredOrders = $user->orders()->where('status', 'delivered')->count();
        $totalSpent = $user->orders()->sum('total_amount');
        $vendorRequest = $user->vendorRequest;

        return view('customer.dashboard', compact(
            'recentOrders',
            'totalOrders',
            'pendingOrders',
            'deliveredOrders',
            'totalSpent',
            'vendorRequest'
        ));
    }
}
