<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function index()
    {
        return view('backoffice', [
            'title' => 'Menu'
        ]);
    }

    public function addProduct()
    {
        return view('add-product', [
            'categories' => Category::all(),
            'title' => 'Add Product'
        ]);
    }

    public function addCategory()
    {
        return view('add-category', [
            'title' => 'Add Category'
        ]);
    }

    public function productManager()
    {
        return view('product-manager', [
            'products' => Product::all()->sortByDesc('updated_at'),
            'title' => 'Product Manager'
        ]);
    }

    public function categoryManager()
    {
        return view('category-manager', [
            'categories' => Category::all(),
            'title' => 'Category Manager'
        ]);
    }

    public function productEdit(Product $product)
    {
        return view('edit-product', [
            'product' => $product,
            'categories' => Category::all(),
            'title' => 'Edit Product'
        ]);
    }

    public function categoryEdit(Category $category)
    {
        return view('edit-category', [
            'category' => $category,
            'title' => 'Edit Category'
        ]);
    }
}
