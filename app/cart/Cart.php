<?php

namespace App\cart;

use App\Models\Product;

class Cart
{
    public function __construct()
    {
        if (!session()->get('cart')) {
            session()->put('cart', []);
        }
    }

    public function add(Product $product)
    {
        $cart = $this->getCart();
        if (isset($cart[$product->id])) {

            // Product exists in cart
            $cart[$product->id]['quantity'] += 1;
        } else {

            // Product not already in cart
            $cart[$product->id] = [
                "quantity" => 1,
            ];
        }

        $this->saveCart($cart);
    }

    public function remove(Product $product)
    {
        $cart = $this->getCart();
        
        if (isset($cart[$product->id])) {
            if ($cart[$product->id]['quantity'] > 1) {
                $cart[$product->id]['quantity'] -= 1;
            } else {
                unset($cart[$product->id]);
            }
        }

        $this->saveCart($cart);
    }

    public function removeAll(Product $product)
    {
        $cart = $this->getCart();
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);

            $this->saveCart($cart);

            return back()->with('success', 'Items removed from cart successfully');
        }
    }

    public static function showCart()
    {
        $cart = session()->get('cart');
        $result = [
            'cart-quantity' => 0,
            'cart-total' => 0,
        ];

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            $result['contents'][$id] = [
                'product' => $product,
                'quantity' => $item['quantity'],
            ];
            $result['cart-quantity'] += $item['quantity'];
            $result['cart-total'] += $product->price * $item['quantity'];
        }
        
        return $result;
    }

    private function getCart()
    {
        return session()->get('cart');
    }

    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }
}
