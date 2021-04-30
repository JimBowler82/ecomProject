<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function index()
    {
        return view('category-manager', [
            'categories' => Category::all(),
            'title' => 'Category Manager'
        ]);
    }

    public function create()
    {
        return view('add-category', [
            'title' => 'Add Category'
        ]);
    }

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

        return Redirect::route('categories.index')->with('success', 'Category added to database');
    }

    public function show(Category $category)
    {
        return view('show-products', [
            'categories' => Category::where('name', '<>', $category->name)->get(),
            'title' => $category->name,
            'products' => $category->products()->paginate(9)
        ]);
    }

    public function edit(Category $category)
    {
        return view('edit-category', [
            'category' => $category,
            'title' => 'Edit Category'
        ]);
    }

    public function update(Category $category)
    {
        $attributes = request()->validate([
            'name' =>['string', 'required', 'max:255'],
            'slug' => ['string', 'alpha_dash', 'unique:App\Models\Category']
        ]);

        $category->update($attributes);

        return Redirect::route('categories.index')->with('success', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::route('categories.index')->with('success', 'Category deleted from database');
    }
}
