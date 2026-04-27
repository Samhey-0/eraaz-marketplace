<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderPlacedNotification;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderController extends Controller
{
    /**
     * Display order history for the authenticated user.
     */
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the checkout page.
     */
    public function checkout()
    {
        $cart = auth()->user()->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cart->load('items.product.vendor');

        return view('orders.checkout', compact('cart'));
    }

    /**
     * Place an order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:255',
            'shipping_zip' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = auth()->user()->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cart->load('items.product');

        // Verify stock availability
        foreach ($cart->items as $item) {
            if ($item->product->stock < $item->quantity) {
                return back()->with('error', "Not enough stock for '{$item->product->name}'. Available: {$item->product->stock}");
            }
        }

        // Create pending order first
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => auth()->id(),
            'total_amount' => $cart->total,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_zip' => $request->shipping_zip,
            'notes' => $request->notes,
        ]);

        // Create Stripe Checkout Session
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'pkr',
                    'product_data' => [
                        'name' => 'Order #' . $order->order_number,
                    ],
                    'unit_amount' => (int) ($cart->total * 100), // Stripe in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success', $order->id) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

        // Save stripe ID
        $order->update(['stripe_payment_intent' => $session->payment_intent]);

        return redirect($session->url);
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Ensure user can only see their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product', 'items.vendor');

        return view('orders.show', compact('order'));
    }
}
