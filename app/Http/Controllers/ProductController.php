<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        return view('product-manager', [
            'products' => Product::all()->sortByDesc('updated_at'),
            'title' => 'Product Manager'
        ]);
    }

    public function create()
    {
        return view('add-product', [
            'categories' => Category::all(),
            'title' => 'Add Product'
        ]);
    }

    public function store()
    {
        // Validate
        $attributes = request()->validate([
            'manufacturer' => ['string', 'required', 'max:255'],
            'model' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'picture' => ['file', 'required'],
            'condition' => ['required', Rule::in(['new', 'refurbished'])],
            'price' => ['numeric', 'required']
        ]);

        // Store the image
        $attributes['picture'] = request('picture')->store('images');

        // Product create
        $product = Product::create([
            'manufacturer' => $attributes['manufacturer'],
            'model' => $attributes['model'],
            'description' => $attributes['description'],
            'picture' => $attributes['picture'],
            'condition' => $attributes['condition'],
            'price' => $attributes['price']
        ]);

        $product->categories()->syncWithoutDetaching(request()->categories);

        return Redirect::route('products.index')->with('success', 'Product added to database');
    }

    public function show(Product $product)
    {
        return view('product-page', [
            'product' => $product,
            'title' => $product->model
        ]);
    }

    public function edit(Product $product)
    {
        return view('edit-product', [
            'product' => $product,
            'categories' => Category::all(),
            'title' => 'Edit Product'
        ]);
    }

    public function update(Product $product)
    {
        // Validate
        $attributes = request()->validate([
            'manufacturer' => ['string', 'required', 'max:255'],
            'model' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'picture' => ['file', 'nullable'],
            'condition' => ['required', Rule::in(['new', 'refurbished'])],
            'price' => ['numeric', 'required']
        ]);

        // If new picture then save it
        if (request('picture')) {
            $attributes['picture'] = request('picture')->store('images');
        }

        // Update the category associatons
        $product->categories()->sync(request()->categories);

        // Update the product
        $product->update($attributes);

        return Redirect::route('products.index')->with('success', 'Product updated in database');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted from database');
    }
}
