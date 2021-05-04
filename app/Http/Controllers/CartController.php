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

        // If no cart is present, create the cart and add first item
        if (!$cart) {
            $cart = [
                "cart-contents" => [

                    $product->id => [
                        "manufacturer" => $product->manufacturer,
                        "model" => $product->model,
                        "quantity" => 1,
                        "price" => $product->price,
                        "picture" => $product->picture
                    ]
                    
                ],
                "cart-total" => $product->price,
                "cart-quantity" => 1,
                
            ];

            session()->put('cart', $cart);

            return back()->with('success', 'Product added to the cart successfully!');
        }

        // If cart exists and product exists in cart already, increment quantity by 1
        if (isset($cart['cart-contents'][$product->id])) {
            $cart['cart-contents'][$product->id]['quantity']++;
            $cart['cart-quantity']++;
            $cart['cart-total'] += $product->price;

            session()->put('cart', $cart);

            return back()->with('success', 'Product added to cart successfully!');
        }

        // If cart exists but product is not present, add product to cart with quantity 1
        $cart['cart-contents'][$product->id] = [
            "manufacturer" => $product->manufacturer,
            "model" => $product->model,
            "quantity" => 1,
            "price" => $product->price,
            "picture" => $product->picture
        ];

        $cart['cart-quantity']++;
        $cart['cart-total'] += $product->price;

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session('cart');

            if (isset($cart['cart-contents'][$request->id])) {
                if ($cart['cart-contents'][$request->id]['quantity'] > 1) {
                    $cart['cart-contents'][$request->id]['quantity']--;
                    $cart['cart-quantity']--;
                    $cart['cart-total'] -= $cart['cart-contents'][$request->id]['price'];
                } else {
                    $cart['cart-quantity']--;
                    $cart['cart-total'] -= $cart['cart-contents'][$request->id]['price'];
                    unset($cart['cart-contents'][$request->id]);
                }
            }

            session()->put('cart', $cart);

            return back()->with('success', 'Product removed successfully');
        }
    }

    public function removeAllOfItem(Product $product)
    {
        $cart = session('cart');

        if ($cart && isset($cart['cart-contents'][$product->id])) {
            $cart['cart-quantity'] -= $cart['cart-contents'][$product->id]['quantity'];
            $cart['cart-total'] -= $cart['cart-contents'][$product->id]['price'] * $cart['cart-contents'][$product->id]['quantity'];
            unset($cart['cart-contents'][$product->id]);

            session()->put('cart', $cart);
            return back()->with('success', 'Items removed from cart successfully');
        }
    }
}
