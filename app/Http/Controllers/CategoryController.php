<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
            'nodes' => Category::get()->toTree(),
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
            'name' =>['string', 'required', 'max:255', 'unique:App\Models\Category'],
            'slug' => ['string', 'alpha_dash', 'unique:App\Models\Category']
        ]);

        $node = Category::create($attributes);

        if (request('operator') === 'root') {
            $node->saveAsRoot();
        } else {
            $parent = Category::find(request('existingCategory'));
            $node->parent()->associate($parent)->save();
        }

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
            'categories' => $category->children,
            'title' => $category->name,
            'current' => $category,
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
            'nodes' => Category::get()->toTree(),
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
            'name' =>['string', 'required', 'max:255', Rule::unique('categories')->ignore($category)],
            'slug' => ['string', 'alpha_dash', Rule::unique('categories')->ignore($category)],
            'operator' => ['required', Rule::in(['root', 'after'])],
        ]);

        $category->update($attributes);

        if (request('operator') == 'root' && $category->isLeaf()) {
            $category->saveAsRoot();
        } elseif (request('operator') == 'after' && $category->isRoot()) {
            $category->parent_id = request('existingCategory');
            $category->save();
        } elseif (request('operator') == 'after' && $category->isLeaf()) {
            if ($category->parent->id != request('existingCategory')) {
                $category->parent_id = request('existingCategory');
                $category->save();
            }
        }

        
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
        $nodes = $category->children;

        foreach ($nodes as $node) {
            $node->parent_id = $category->parent_id;
            $node->save();
        }

        $category->delete();

        return Redirect::route('categories.index')->with('success', 'Category deleted from database');
    }
}
