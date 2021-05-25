<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

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
            'categories' => Category::whereIsRoot()->with('image')->get(),
            'title' => 'Latest Products',
            'products' => Product::with('images')->latest()->filter(request(['search']))->paginate(9),
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
            'title' => 'Menu',
        ]);
    }
}
