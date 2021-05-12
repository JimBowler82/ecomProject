<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }


    /**
     * Index
     *
     * Shows all categories in the database.
     *
     * @return void
     */
    public function index()
    {
        return view('category.category-manager', [
            'categories' => Category::all(),
            'title' => 'Category Manager'
        ]);
    }


    /**
     * Create
     *
     * Return the view for create a category
     *
     * @return void
     */
    public function create()
    {
        return view('category.add-category', [
            'title' => 'Add Category'
        ]);
    }


    /**
     * Store
     *
     * Adds a new category to the database
     *
     * @return void
     */
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


    /**
     * Show
     *
     * Show all products for a particular category
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        return view('show-products', [
            // 'categories' => Category::where('name', '<>', $category->name)->get(),
            'title' => $category->name,
            'products' => $category->products()->paginate(9)
        ]);
    }


    /**
     * Edit
     *
     * Return the view to edit a particular category
     *
     * @param Category $category
     * @return void
     */
    public function edit(Category $category)
    {
        return view('category.edit-category', [
            'category' => $category,
            'title' => 'Edit Category'
        ]);
    }


    /**
     * Update
     *
     * Updates a given category
     *
     * @param Category $category
     * @return void
     */
    public function update(Category $category)
    {
        $attributes = request()->validate([
            'name' =>['string', 'required', 'max:255'],
            'slug' => ['string', 'alpha_dash', Rule::unique('categories')->ignore($category)],
        ]);

        $category->update($attributes);

        return Redirect::route('categories.index')->with('success', 'Category updated');
    }


    /**
     * Destroy
     *
     * Delete a particular category from the database
     *
     * @param Category $category
     * @return void
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::route('categories.index')->with('success', 'Category deleted from database');
    }
}
