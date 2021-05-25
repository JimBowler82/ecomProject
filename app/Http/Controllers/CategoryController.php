<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Images used by seeder, Not to be deleted from storage
     *
     * @var array
     */
    private $protectedImages = [
        'images/new_phones.webp',
        'images/headphones.webp',
        'images/default-avatar.jpeg',
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'destructureCategoryFromSlug']);
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
            'categories' => Category::with(['image', 'products'])->withDepth()->get()->toFlatTree(),
            'title' => 'Category Manager',
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
            'title' => 'Add Category',
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
            'name' => ['string', 'required', 'max:255'],
            'slug' => ['string', 'alpha_dash'],
            'operator' => ['required', Rule::in(['root', 'after'])],
            'picture' => ['file'],
        ]);

        $node = Category::create($attributes);

        if (request('operator') === 'root') {
            $node->saveAsRoot();
        } else {
            $parent = Category::find(request('existingCategory'));
            $node->parent()->associate($parent)->save();
        }

        if (request('picture')) {
            // Store the image
            $attributes['picture'] = request('picture')->store('images');

            // Image - Product association
            $node->image()->save(new Image(['location' => $attributes['picture']]));
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
        $categories = $category->descendants()->with('products.images')->get()->pluck('products');
        $categories[] = $category->products;
        //dd($categories);

        return view('show-products', [
            'categories' => $category->children()->with('image')->get(),
            'title' => $category->name,
            'parent_path' => $category->parent_path,
            'ancestors' => Category::ancestorsAndSelf($category->id),
            'products' => $categories->flatten(1)->paginate(9),
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
            'title' => 'Edit Category',
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
            'name' => ['string', 'required', 'max:255'],
            'slug' => ['string', 'alpha_dash'],
            'operator' => ['required', Rule::in(['root', 'after'])],
            'picture' => ['file', 'nullable'],
        ]);

        // Update category heirarchy
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

        // If new picture, remove old and then save new
        if (request('picture') && isset($category->image->location)) {
            if (Storage::exists($category->image->location) && !in_array($category->image->location, $this->protectedImages)) {
                Storage::delete($category->image->location);
            }

            $attributes['picture'] = request('picture')->store('images');

            // Destroy old image model
            Image::destroy($category->image->id);

            // Create new Image - Category association
            $category->image()->save(new Image(['location' => $attributes['picture']]));
        } elseif (request('picture')) {
            $attributes['picture'] = request('picture')->store('images');

            // Create new Image - Category association
            $category->image()->save(new Image(['location' => $attributes['picture']]));
        }

        // Update the product type
        $category->update(array_filter($attributes, function ($key) {
            return $key != 'picture';
        }, ARRAY_FILTER_USE_KEY));

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

        $image = $category->image->location ?? null;

        // Remove image from storage
        if (Storage::exists($image) && !in_array($image, $this->protectedImages)) {
            Storage::delete($image);
        }

        // Delete type and image from database
        $category->delete();

        return Redirect::route('categories.index')->with('success', 'Category deleted from database');
    }

    /**
     * Destructure category from slug heirarchy
     *
     * @param Request $request
     * @param Array $categories
     * @return void
     */
    public function destructureCategoryFromSlug(Request $request, $categories)
    {
        $segments = $request->segments();
        $segmentsCount = count($request->segments());
        $categories = explode('/', $categories);
        $categorySlug = array_pop($categories);

        if ($segmentsCount > 1) {
            $parent = Category::where('slug', $segments[$segmentsCount - 2])->firstOrFail();

            return $this->show(Category::where('slug', $categorySlug)->where('parent_id', $parent->id)->firstOrFail());
        }

        return $this->show(Category::where('slug', $categorySlug)->firstOrFail());
    }
}
