<?php

namespace App\cart;

use App\Models\Product;

class Cart
{

    /**
     * Constructor
     *
     * If a cart is not present in the session, then create a cart.
     *
     */
    public function __construct()
    {
        if (!session()->get('cart')) {
            session()->put('cart', []);
        }
    }

    /**
     * Add
     *
     * Add a product to the cart, updating quantities.
     *
     * @param Product $product
     * @return void
     */
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

    /**
     * Remove
     *
     * Remove a product from the cart, updating quantities.
     *
     * @param Product $product
     * @return void
     */
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

    /**
     * Remove All
     *
     * Remove all quantity of a particular product.
     *
     * @param Product $product
     * @return void
     */
    public function removeAll(Product $product)
    {
        $cart = $this->getCart();
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);

            $this->saveCart($cart);

            return back()->with('success', 'Items removed from cart successfully');
        }
    }

    /**
     * Show Cart
     *
     * Constructs an array containing all details of every product in the cart,
     * includes calculated totals. - For use displaying cart on front-end.
     *
     * @return array
     */
    public static function showCart()
    {
        $cart = session()->get('cart');
        if ($cart) {
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

        return null;
    }

    /**
     * Get Cart
     *
     * returns the current cart from the session.
     *
     * @return array
     */
    private function getCart()
    {
        return session()->get('cart');
    }

    /**
     * Save Cart
     *
     * Saves a modified cart to the session under the 'cart' key.
     *
     * @param Array $cart
     * @return void
     */
    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }
}
