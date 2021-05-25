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
            'productTypes' => ProductType::filter(request(['search']))->get(),
            'title' => 'Product Type Manager',
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
            'properties' => ['json'],
        ]);

        $productType = ProductType::create([
            'name' => $attributes['name'],
            'slug' => $attributes['slug'],
            'properties' => serialize(json_decode(request()->properties)),
        ]);

        return Redirect::route('productTypes.index')->with('success', 'Product type added!');
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
            'productType' => $productType,
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
            'properties' => ['json'],
        ]);

        $attributes['properties'] = serialize(json_decode(request()->properties));

        $productType->update($attributes);

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
        // Delete type from database
        $productType->delete();

        return Redirect::route('productTypes.index')->with('success', 'Type deleted from database');
    }
}
