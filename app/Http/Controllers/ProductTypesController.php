<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Index
     *
     * Show all product types in the database
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
     * Returns the view to edit a product type
     *
     * @return void
     */
    public function edit()
    {
        dd('product type - edit');
    }


    public function update()
    {
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
