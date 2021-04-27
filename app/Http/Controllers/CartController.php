<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Float_;

class CartController extends Controller
{
    public function show()
    {
        $data = session('cart');
        return view('cart', [
            'cart' => $data,
        ]);
    }

    public function addToCart(Product $product)
    {
        if (!$product) {
            abort(404);
        }


        $cart = session()->get('cart');
        //dd($cart);

        // If no cart is present, create the cart and add first item
        if (!$cart) {
            $cart = [
                $product->id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "picture" => $product->picture
                ]
            ];

            session()->put('cart', $cart);

            return back()->with('success', 'product added to the cart successfully!');
        }

        // If cart exists and product exists in cart already, increment quantity by 1
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;

            session()->put('cart', $cart);

            return back()->with('success', 'Product added to cart successfully!');
        }

        // If cart exists but product is not present, add product to cart with quantity 1
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "picture" => $product->picture
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully!');
    }

    public function cartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['quantity'] + $details['price'];
        }

        return $total;
    }

    public function cartQuantity($cart)
    {
        $quantity = 0;
        foreach ($cart as $id => $details) {
            $quantity += $details['quantity'];
        }

        return $quantity;
    }
}
