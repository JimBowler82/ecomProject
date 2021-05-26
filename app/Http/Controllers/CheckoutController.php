<?php

namespace App\Http\Controllers;

use App\cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
                'quantity' => 1,
            ];
        }, $cart['contents']);

        $session = \Stripe\Checkout\Session::create([
            'billing_address_collection' => 'required',
            'payment_method_types' => ['card'],
            'line_items' => [...$line_items],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => url('/cart'),
        ]);

        return Response::json(['id' => $session->id], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
