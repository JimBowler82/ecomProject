<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    public function index()
    {
        return view('show-products', [
            'productTypes' => ProductType::all(),
            'title' => 'Latest Products',
            'products' => Product::orderBy('updated_at', 'desc')->paginate(9)
            
        ]);
    }

    public function show(ProductType $productType)
    {
        return view('show-products', [
            'productType' => $productType,
            'title' => $productType->name,
            'active' => '',
            'products' => $productType->products()->orderBy('updated_at', 'desc')->paginate(9),
            'categories' => $productType->subcategories()
        ]);
    }
}
