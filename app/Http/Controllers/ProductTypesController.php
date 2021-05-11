<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    public function show(ProductType $productType)
    {
        return view('show-products', [
            'title' => $productType->name,
            'products' => Product::orderBy('updated_at', 'desc')->paginate(9),
            'categories' => $productType->subcategories()
        ]);
    }
}
