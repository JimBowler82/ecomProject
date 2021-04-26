<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('show-products', [
            'categories' => Category::all(),
            'title' => 'Latest Products',
            'products' => Product::orderBy('updated_at', 'desc')->paginate(9)
        ]);
    }

    public function category(Category $category)
    {
        return view('show-products', [
            'categories' => Category::where('name', '<>', $category->name)->get(),
            'title' => $category->name,
            'products' => $category->products()->paginate(9)
        ]);
    }

    public function product(Product $product)
    {
        return view('product-page', [
            'product' => $product
        ]);
    }

    public function portal()
    {
        return view('portal');
    }
}
