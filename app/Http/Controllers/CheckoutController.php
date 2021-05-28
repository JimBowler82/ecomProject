<?php

namespace App\Http\Controllers;

use App\cart\Cart;
use App\Mail\SuccessfulCheckout;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = Cart::showCart();

        // Construct line items array from users cart
        $line_items = array_map(function ($entry) {
            return [
                'price_data' => [
                    'currency' => 'gbp',
                    'unit_amount' => $entry['product']->price,
                    'product_data' => [
                        'name' => $entry['product']->manufacturer . " " . $entry['product']->model,
                        'description' => $entry['product']->condition . ", " . implode(', ', $entry['product']->attributes),
                        'images' => ["https://picsum.photos/id/1074/400"],

                    ],
                ],
                'quantity' => $entry['quantity'],
            ];
        }, $cart['contents']);

        // Stripe session object createion
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'shipping_rates' => ['shr_1IvNQVDxNWDqAM5zvrGW83VI'],
            'shipping_address_collection' => [
                'allowed_countries' => ['US', 'CA', 'GB'],
            ],
            'line_items' => [...$line_items],
            'mode' => 'payment',
            'success_url' => url('checkout/success'),
            'cancel_url' => url('/cart'),
        ]);

        return Response::json(['id' => $session->id], 200);

    }

    /**
     * Store
     *
     * Handles webhook events for completed checkout sessions
     *  - Validates the incoming event is from Stripe
     *  - Create a new Order object in the database from the Stripe session data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Set your secret key
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Helper to print out to server log
        function print_log($val)
        {
            return file_put_contents('php://stderr', print_r($val, true));
        }

        // Grab payload and validate Stripe event
        $endpoint_secret = env('STRIPE_ENDPOINT_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException$e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException$e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Create Order object for database
        function fulfill_order($session)
        {
            print_log("Fulfilling order...");

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $line_items = $stripe->checkout->sessions->allLineItems($session->id, ['limit' => 5]);

            $order = Order::create([
                'session_id' => $session->id,
                'customer_name' => $session->shipping->name,
                'customer_email' => $session->customer_details->email,
                'line_items' => $line_items->data,
                'status' => $session->payment_status,
                'address' => $session->shipping->address->toArray(),
                'sub_total' => $session->amount_subtotal,
                'total' => $session->amount_total,
                'payment_intent' => $session->payment_intent,
            ]);

            // Send Mailable
            Mail::to($order->customer_email)->send(new SuccessfulCheckout($order));
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // Fulfill the purchase...
            fulfill_order($session);
        }

        http_response_code(200);

    }

    /**
     * Show
     *
     * Returns the successfull checkout view informing customer
     * that the checkout was successful.
     *
     */
    public function show()
    {
        session()->put('cart', []);
        return view('checkout.success');

    }

}
