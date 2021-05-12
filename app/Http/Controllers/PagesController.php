<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('show-products', [
            'productTypes' => ProductType::all(),
            'title' => 'Latest Products',
            'products' => Product::orderBy('updated_at', 'desc')->paginate(9)
        ]);
    }

    public function backOffice()
    {
        return view('backoffice', [
            'title' => 'Menu'
        ]);
    }
}
