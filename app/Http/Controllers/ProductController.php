<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function store()
    {
        //dd(request('picture'));
        $attributes = request()->validate([
            'manufacturer' => ['string', 'required', 'max:255'],
            'model' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'picture' => ['file', 'required'],
            'condition' => ['required', Rule::in(['new', 'refubished'])],
            'price' => ['numeric', 'required']
        ]);

        // Store the image
        $attributes['picture'] = request('picture')->store('images');

        // Product create
        Product::create([
            'manufacturer' => $attributes['manufacturer'],
            'model' => $attributes['model'],
            'description' => $attributes['description'],
            'picture' => $attributes['picture'],
            'condition' => $attributes['condition'],
            'price' => $attributes['price']
        ]);

        return back()->with('success', 'Product added to database');
    }
}
