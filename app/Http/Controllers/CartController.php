<?php

namespace App\Http\Controllers;

use App\cart\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function show()
    {
        return view('cart', [
            'cart' => $this->cart->showCart(),
        ]);
    }

    public function addToCart(Product $product)
    {
        if (!$product) {
            abort(404);
        }

        $this->cart->addProduct($product);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $this->cart->removeProduct($request);

            return back()->with('success', 'Product removed successfully');
        }
    }

    public function removeAllOfItem(Product $product)
    {
        if ($product) {
            $this->cart->removeAllOfProduct($product);

            return back()->with('success', 'Items removed from cart successfully');
        }
    }
}
