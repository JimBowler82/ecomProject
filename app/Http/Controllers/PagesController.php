<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * Home
     *
     * Return the homepage view showing all products and product types
     *
     * @return void
     */
    public function home()
    {
        return view('show-products', [
            'productTypes' => ProductType::all(),
            'title' => 'Latest Products',
            'products' => Product::orderBy('updated_at', 'desc')->paginate(9)
        ]);
    }

    /**
     * BackOffice
     *
     * Return the view for the backoffice
     *
     * @return void
     */
    public function backOffice()
    {
        return view('backoffice', [
            'title' => 'Menu'
        ]);
    }
}
