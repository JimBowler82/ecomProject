<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class TypeCategoryController extends Controller
{

    /**
     * Show
     *
     * Returns the view to show all products for a given product type and category
     *
     * @param ProductType $productType
     * @param Category $category
     * @return void
     */
    public function show(ProductType $productType, Category $category)
    {
        return view('show-products', [
            'productType' => $productType,
            'active' => $category->slug,
            'categories' => $productType->subcategories(),
            'title' => "$productType->name / $category->name",
            'products' => $category->products()->where('product_type_id', $productType->id)->paginate(9)
        ]);
    }
}
