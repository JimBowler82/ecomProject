<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('show-products', [
            'categories' => Category::all(),
            'title' => 'Latest Products',
            'products' => Product::orderBy('updated_at', 'desc')->paginate(9)
            
        ]);
    }

    public function portal()
    {
        return view('portal');
    }

    public function backOffice()
    {
        return view('backoffice', [
            'title' => 'Menu'
        ]);
    }
}
