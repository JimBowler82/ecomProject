<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function index()
    {
        return view('backoffice');
    }

    public function addProduct()
    {
        return view('add-product', [
            'categories' => Category::all()
        ]);
    }

    public function addCategory()
    {
        return view('add-category');
    }

    public function productManager()
    {
        return view('product-manager', [
            'products' => Product::all()->sortByDesc('updated_at')
        ]);
    }

    public function categoryManager()
    {
        return view('category-manager', [
            'categories' => Category::all()
        ]);
    }

    public function productEdit(Product $product)
    {
        return view('edit-product', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function categoryEdit(Category $category)
    {
        return view('edit-category', [
            'category' => $category
        ]);
    }
}
