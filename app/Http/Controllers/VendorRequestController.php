<?php

namespace App\Http\Controllers;

use App\Models\VendorRequest;
use App\Notifications\VendorApprovedNotification;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
    /**
     * Show the vendor application form.
     */
    public function create()
    {
        $existingRequest = auth()->user()->vendorRequest;

        return view('vendor-request.create', compact('existingRequest'));
    }

    /**
     * Store a vendor application request.
     */
    public function store(Request $request)
    {
        // Check if user already has a pending request
        $existing = auth()->user()->vendorRequest;
        if ($existing) {
            return back()->with('error', 'You already have a vendor application on file.');
        }

        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_description' => 'required|string|max:1000',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        VendorRequest::create([
            'user_id' => auth()->id(),
            'business_name' => $request->business_name,
            'business_description' => $request->business_description,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Vendor application submitted successfully! We will review it soon.');
    }
}
