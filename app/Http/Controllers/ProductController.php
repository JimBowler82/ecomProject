<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
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
     * Shows all products in the database
     *
     * @return void
     */
    public function index()
    {
        return view('product.product-manager', [
            'products' => Product::with([
                'images',
                'categories',
                'productType'
            ])->orderBy('updated_at', 'desc')->get(),
            'title' => 'Product Manager'
        ]);
    }

    /**
     * Create
     *
     * Returns the view for create a product
     *
     * @return void
     */
    public function create()
    {
        return view('product.add-product', [
            'nodes' => Category::get()->toTree(),
            'productTypes' => ProductType::all(),
            'title' => 'Add Product'
        ]);
    }

    /**
     * Store
     *
     * Creates a new Product, stores associated image, adds image to database,
     * and creates new assocation between Product & Image.
     *
     * @return void
     */
    public function store()
    {
        

        // Validate
        $attributes = request()->validate([
            'productType' => ['required', 'integer'],
            'manufacturer' => ['string', 'required', 'max:255'],
            'model' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'picture' => ['file', 'required'],
            'condition' => ['required', Rule::in(['new', 'refurbished'])],
            'price' => ['numeric', 'required'],
            'slug' => ['string', 'alpha_dash', 'unique:App\Models\Product'],
            'attributes' => ['nullable', 'JSON'],
            'mainCategory' => ['required', 'numeric']
        ]);

        // Product create
        $product = Product::create([
            'product_type_id' => $attributes['productType'],
            'manufacturer' => $attributes['manufacturer'],
            'model' => $attributes['model'],
            'description' => $attributes['description'],
            'attributes' => json_decode($attributes['attributes']),
            'condition' => $attributes['condition'],
            'slug' => $attributes['slug'],
            'price' => (int) bcmul($attributes['price'], 100.0),
        ]);

        // Store the image
        $attributes['picture'] = request('picture')->store('images');
        
        // Image - Product association
        $product->images()->save(new Image(['location' => $attributes['picture']]));

        // Product - Categories association
        $product->categories()->syncWithoutDetaching(request('mainCategory'));

        return Redirect::route('products.index')->with('success', 'Product added to database');
    }

    /**
     * Show
     *
     * Shows an individual product.
     * Returns the view for the product-page.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        return view('product.product-page', [
            'product' => $product,
            'title' => $product->model
        ]);
    }

    /**
     * Edit
     *
     * Returns the view for the edit-product page
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        return view('product.edit-product', [
            'nodes' => Category::get()->toTree(),
            'product' => $product,
            'productTypes' => ProductType::all(),
            'title' => 'Edit Product'
        ]);
    }

    /**
     * Update
     *
     * Updates properties for an existing product.
     * If an image has been changed, the old image is removed from storage
     * and from the database before the new one is added.
     *
     * @param Product $product
     * @return void
     */
    public function update(Product $product)
    {
        // Validate
        $attributes = request()->validate([
            'product_type_id' => ['required', 'integer'],
            'manufacturer' => ['string', 'required', 'max:255'],
            'model' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'picture' => ['file', 'nullable'],
            'condition' => ['required', Rule::in(['new', 'refurbished'])],
            'price' => ['numeric', 'required'],
            'slug' => ['string', 'alpha_dash', Rule::unique('products')->ignore($product)],
            'attributes' => ['nullable', 'JSON']
        ]);

        // If new picture, remove old and then save new
        if (request('picture')) {
            if (Storage::exists($product->images->first()->location)) {
                Storage::delete($product->images->first()->location);
            }
            
            $attributes['picture'] = request('picture')->store('images');

            // Destroy old image model
            Image::destroy($product->images->first()->id);

            // Create new Image - Product association
            $product->images->save(new Image(['location' => $attributes['picture']]));
        }

        // Convert pounds to pence
        if (request('price')) {
            $attributes['price'] = (int) bcmul($attributes['price'], 100.0);
        }

        // Update the category associatons
        $product->categories()->sync(request('mainCategory'));

        // Attributes to json 'attributes' => json_decode(request('attributes')),
        $attributes['attributes'] = json_decode($attributes['attributes']);

        // Update the product
        $product->update(array_filter($attributes, function ($key) {
            return $key != 'picture' || $key != 'mainCategory';
        }, ARRAY_FILTER_USE_KEY));

        return Redirect::route('products.index')->with('success', 'Product updated in database');
    }

    /**
     * Destroy
     *
     * Delete a product from the database
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        $images = $product->images->get();
        
        foreach ($images as $image) {
            // Remove image from storage
            if (Storage::exists($image->location)) {
                Storage::delete($image->location);
            }
        }
        
        $product->delete();

        return back()->with('success', 'Product deleted from database');
    }
}
