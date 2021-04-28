<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'name' =>['string', 'required', 'max:255'],
            'slug' => ['string', 'alpha_dash', 'unique:App\Models\Category']
        ]);

        Category::create([
            'name' => $attributes['name'],
            'slug' => $attributes['slug']
        ]);

        return back()->with('success', 'Category added to database');
    }
}
