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

    public function add(Product $product)
    {
        if (!$product) {
            abort(404);
        }

        $this->cart->add($product);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Product $product)
    {
        if ($product) {
            $this->cart->remove($product);

            return back()->with('success', 'Product removed successfully');
        }
    }

    public function removeAll(Product $product)
    {
        if ($product) {
            $this->cart->removeAll($product);

            return back()->with('success', 'Items removed from cart successfully');
        }
    }
}
