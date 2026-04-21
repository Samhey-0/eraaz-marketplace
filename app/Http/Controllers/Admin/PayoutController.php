<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index()
    {
        // Get all vendors with their earnings metrics
        $vendors = User::where('role', 'vendor')
            ->withSum(['vendorEarnings as available_earnings' => function ($query) {
                $query->where('status', 'available');
            }], 'vendor_earning')
            ->withSum(['vendorEarnings as pending_earnings' => function ($query) {
                $query->where('status', 'pending');
            }], 'vendor_earning')
            ->paginate(15);

        // Recent generic payouts history across platform
        $payouts = Payout::with('vendor')->latest()->paginate(10);

        return view('admin.payouts.index', compact('vendors', 'payouts'));
    }

    public function process(Request $request, User $vendor)
    {
        // Simple logic: payout all 'available' earnings for this vendor
        $availableEarnings = $vendor->vendorEarnings()->where('status', 'available')->get();
        $amountToPay = $availableEarnings->sum('vendor_earning');

        if ($amountToPay <= 0) {
            return back()->with('error', 'Vendor has no available earnings to payout.');
        }

        // Create Payout Record
        $payout = Payout::create([
            'vendor_id' => $vendor->id,
            'amount' => $amountToPay,
            'payment_method' => 'Bank Transfer / Manual',
            'status' => 'completed',
        ]);

        // Mark earnings as paid
        $vendor->vendorEarnings()->where('status', 'available')->update(['status' => 'paid']);

        // Notify the vendor
        try {
            $vendor->notify(new \App\Notifications\PayoutProcessedNotification($payout));
        } catch (\Exception $e) {
            // Skip if notification fails
        }

        return back()->with('success', 'Successfully processed payout of Rs. ' . number_format($amountToPay, 2) . ' for ' . $vendor->name);
    }
}
