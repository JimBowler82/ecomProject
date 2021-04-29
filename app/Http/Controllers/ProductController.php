<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
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

        return redirect('/backoffice/productManager')->with('success', 'Product added to database');
    }

    public function editProduct(Product $product)
    {
        //dd(request());

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

        return redirect('/backoffice/productManager')->with('success', 'Product updated in database');
    }

    public function delete(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted from database');
    }
}
