<?php

namespace App\Http\Controllers;

use App\cart\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public $cart;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cart = new Cart();
    }

    /**
     * Show
     *
     * Returns the view to show current cart state
     *
     * @return void
     */
    public function show()
    {
        return view('cart', [
            'cart' => $this->cart->showCart(),
        ]);
    }

    /**
     * Add
     *
     * Calls cart method to adds a given product to the cart
     *
     * @param Product $product
     * @return void
     */
    public function add(Product $product)
    {
        if (!$product) {
            abort(404);
        }

        $this->cart->add($product);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Remove
     *
     * Calls cart method to removes a given product from the cart
     *
     * @param Product $product
     * @return void
     */
    public function remove(Product $product)
    {
        if ($product) {
            $this->cart->remove($product);

            return back()->with('success', 'Product removed successfully');
        }
    }

    /**
     * Remove
     *
     * Calls cart method to remove all of a given product from the cart
     *
     * @param Product $product
     * @return void
     */
    public function removeAll(Product $product)
    {
        if ($product) {
            $this->cart->removeAll($product);

            return back()->with('success', 'Items removed from cart successfully');
        }
    }
}
