<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorRequest;
use App\Notifications\VendorApprovedNotification;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
    /**
     * Display a listing of vendor requests.
     */
    public function index()
    {
        $requests = VendorRequest::with('user')->latest()->paginate(15);
        return view('admin.vendor-requests.index', compact('requests'));
    }

    /**
     * Show a specific vendor request.
     */
    public function show(VendorRequest $vendorRequest)
    {
        $vendorRequest->load('user');
        return view('admin.vendor-requests.show', compact('vendorRequest'));
    }

    /**
     * Approve a vendor request.
     */
    public function approve(VendorRequest $vendorRequest)
    {
        $vendorRequest->update(['status' => 'approved']);
        $vendorRequest->user->update(['role' => 'vendor']);

        // Send notification
        try {
            $vendorRequest->user->notify(new VendorApprovedNotification());
        } catch (\Exception $e) {
            // Don't fail if notification fails
        }

        return back()->with('success', 'Vendor request approved. User has been promoted to vendor.');
    }

    /**
     * Reject a vendor request.
     */
    public function reject(Request $request, VendorRequest $vendorRequest)
    {
        $request->validate([
            'admin_note' => 'nullable|string|max:500',
        ]);

        $vendorRequest->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
        ]);

        return back()->with('success', 'Vendor request rejected.');
    }
}
