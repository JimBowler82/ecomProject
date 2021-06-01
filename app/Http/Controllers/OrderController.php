<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index
     *
     * Shows all orders in the database
     *
     * @return void
     */
    public function index()
    {
        return view('order.order-manager', [
            'orders' => Order::latest()->filter(request(['search', 'date_search']))->get(),
            'title' => 'Order Manager',
        ]);
    }

    public function show(Order $order)
    {
        $stripe = new \Stripe\StripeClient("sk_test_51IvJg8DxNWDqAM5zB7IyAFMWmpJEAacK9bVP6uYxU0N3giwDIL59dIlDybkqUmoC8P0Bew3bfAxoIur7KQzQOVVw00SehNZPh5");
        $paymentObject = $stripe->paymentIntents->retrieve($order->payment_intent, []);

        return view('order.view-order', [
            'order' => $order,
            'paymentObject' => $paymentObject,
            'title' => 'View Order',
        ]);
    }

    /**
     * Delete
     *
     * Delete an order from the database
     *
     * @param Order $order
     * @return void
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('success', 'Order deleted from database');
    }

}
