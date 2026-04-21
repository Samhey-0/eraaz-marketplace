<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Calculate summaries
        $totalEarned = $user->vendorEarnings()->where('status', '!=', 'pending')->sum('vendor_earning');
        $pendingClearance = $user->vendorEarnings()->where('status', 'pending')->sum('vendor_earning');
        $availablePayout = $user->vendorEarnings()->where('status', 'available')->sum('vendor_earning');
        $totalPaidOut = $user->payouts()->where('status', 'completed')->sum('amount');

        // Recent Earnings
        $earnings = $user->vendorEarnings()->with('order')->latest()->paginate(10);
        
        // Recent Payouts
        $payouts = $user->payouts()->latest()->paginate(5);

        return view('vendor.earnings.index', compact(
            'totalEarned',
            'pendingClearance',
            'availablePayout',
            'totalPaidOut',
            'earnings',
            'payouts'
        ));
    }
}
