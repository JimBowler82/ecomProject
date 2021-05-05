<?php

namespace App\cart;

use App\Models\Product;

class Cart
{
    public function __construct()
    {
        if (!session()->get('cart')) {
            session()->put('cart', [
                "cart-contents" => [],
                "cart-total" => 0,
                "cart-quantity" => 0,
            ]);
        }
    }

    public function addProduct(Product $product)
    {
        $cart = $this->getCart();
        if (isset($cart['cart-contents'][$product->id])) {

            // Product exists in cart
            $cart['cart-contents'][$product->id]['quantity'] += 1;
            $cart['cart-quantity'] += 1;
            $cart['cart-total'] += $product->price;
        } else {

            // Product not already in cart
            $cart['cart-contents'][$product->id] = [
                "manufacturer" => $product->manufacturer,
                "model" => $product->model,
                "quantity" => 1,
                "price" => $product->price,
                "picture" => $product->picture
            ];
            $cart['cart-total'] += $product->price;
            $cart['cart-quantity'] += 1;
        }

        $this->saveCart($cart);
    }

    public function removeProduct($request)
    {
        $cart = $this->getCart();
        
        if (isset($cart['cart-contents'][$request->id])) {
            if ($cart['cart-contents'][$request->id]['quantity'] > 1) {
                $cart['cart-contents'][$request->id]['quantity'] -= 1;
                $cart['cart-quantity'] -= 1;
                $cart['cart-total'] -= $cart['cart-contents'][$request->id]['price'];
            } else {
                $cart['cart-quantity'] -= 1;
                $cart['cart-total'] -= $cart['cart-contents'][$request->id]['price'];
                unset($cart['cart-contents'][$request->id]);
            }
        }

        $this->saveCart($cart);
    }

    public function removeAllOfProduct(Product $product)
    {
        $cart = $this->getCart();
        if (isset($cart['cart-contents'][$product->id])) {
            $cart['cart-quantity'] -= $cart['cart-contents'][$product->id]['quantity'];
            $cart['cart-total'] -= $cart['cart-contents'][$product->id]['price'] * $cart['cart-contents'][$product->id]['quantity'];
            unset($cart['cart-contents'][$product->id]);

            $this->saveCart($cart);

            return back()->with('success', 'Items removed from cart successfully');
        }
    }

    public function getCart()
    {
        return session()->get('cart');
    }

    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }
}
