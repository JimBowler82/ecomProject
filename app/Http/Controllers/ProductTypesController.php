<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductTypesController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Index
     *
     * Shows all product types in the database
     *
     * @return void
     */
    public function index()
    {
        return view('productTypes.productType-manager', [
            'productTypes' => ProductType::all(),
            'title' => 'Product Type Manager'
        ]);
    }

    /**
     * Create
     *
     * Return the view for create a product type
     *
     * @return void
     */
    public function create()
    {
        return view('productTypes.add-productType', [
            'title' => 'Add Product Type',
        ]);
    }

    /**
     * Store
     *
     * Adds a new product type to the database
     *
     * @return void
     */
    public function store()
    {
        $attributes = request()->validate([
            'name' => ['string', 'required', 'max:255'],
            'slug' => ['string', 'alpha_dash', 'unique:App\Models\ProductType'],
            'picture' => ['file', 'required'],
        ]);

        $productType = ProductType::create([
            'name' => $attributes['name'],
            'slug' => $attributes['slug']
        ]);

        // Store the image
        $attributes['picture'] = request('picture')->store('images');
        
        // Image - Product association
        $productType->image()->save(new Image(['location' => $attributes['picture']]));

        return Redirect::route('productTypes.index')->with('success', 'Product type added!');
    }
    

    /**
     * Show
     *
     * Show all products linked to a particular product type
     *
     * @param ProductType $productType
     * @return void
     */
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


    /**
     * Edit
     *
     * Returns the view to edit a particular product type
     *
     * @param ProductType $productType
     * @return void
     */
    public function edit(ProductType $productType)
    {
        return view('productTypes.edit-productType', [
            'title' => 'Edit Product Type',
            'productType' => $productType
        ]);
    }


    /**
     * Update
     *
     * Updates a given product type.
     * If an image has been changed, the old image is removed from storage
     * and from the database before the new one is added.
     *
     * @param ProductType $productType
     * @return void
     */
    public function update(ProductType $productType)
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['string', 'alpha_dash', Rule::unique('product_types')->ignore($productType)],
            'picture' => ['file', 'nullable']
        ]);

        // If new picture, remove old and then save new
        if (request('picture')) {
            if (Storage::exists($productType->image->location)) {
                Storage::delete($productType->image->location);
            }
            
            $attributes['picture'] = request('picture')->store('images');

            // Destroy old image model
            Image::destroy($productType->image->id);

            // Create new Image - ProductType association
            $productType->image()->save(new Image(['location' => $attributes['picture']]));

            // Update the product type
            $productType->update(array_filter($attributes, function ($key) {
                return $key != 'picture';
            }, ARRAY_FILTER_USE_KEY));
        }

        return Redirect::route('productTypes.index')->with('success', 'Product type updated');
    }


    /**
     * Destroy
     *
     * Delete product type from database and associated image
     *
     * @param ProductType $productType
     * @return void
     */
    public function destroy(ProductType $productType)
    {
        $image = $productType->image->location;
        
        // Remove image from storage
        if (Storage::exists($image)) {
            Storage::delete($image);
        }

        // Delete type and image from database
        $productType->delete();

        return Redirect::route('productTypes.index')->with('success', 'Type deleted from database');
    }
}
