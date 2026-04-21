<?php

namespace App\Services;

use App\Models\Order;
use App\Models\VendorEarning;

class CommissionService
{
    /**
     * The global default commission rate (e.g. 10%).
     * Could be moved to config/settings later.
     */
    protected float $defaultCommissionRate = 10.0;

    /**
     * Calculate and record commissions for a given order.
     * This should typically be called after an order is marked as 'paid' or 'delivered'.
     *
     * @param Order $order
     * @return void
     */
    public function calculateForOrder(Order $order): void
    {
        // Prevent recalculation if earnings already exist
        if (VendorEarning::where('order_id', $order->id)->exists()) {
            return;
        }

        // We load the items with their associated vendors
        $order->loadMissing('items.vendor');

        // Group order items by vendor
        $itemsByVendor = $order->items->groupBy('vendor_id');

        foreach ($itemsByVendor as $vendorId => $items) {
            $vendor = $items->first()->vendor;

            // Determine the commission rate
            // Vendor's custom rate or the global default
            $rate = $vendor->vendor_commission_rate ?? $this->defaultCommissionRate;

            $totalSales = $items->sum('subtotal');
            $adminCommission = $totalSales * ($rate / 100);
            $vendorEarning = $totalSales - $adminCommission;

            VendorEarning::create([
                'vendor_id' => $vendorId,
                'order_id' => $order->id,
                'total_sales' => $totalSales,
                'admin_commission' => $adminCommission,
                'vendor_earning' => $vendorEarning,
                'status' => 'pending', // Becomes 'available' when order is complete/delivered
            ]);

            // Notify the vendor
            try {
                $vendor->notify(new \App\Notifications\NewSaleNotification($order, $vendorEarning));
            } catch (\Exception $e) {
                // Skip if notification fails
            }
        }
    }
}
