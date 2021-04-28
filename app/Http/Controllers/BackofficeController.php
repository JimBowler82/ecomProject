<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function index()
    {
        return view('backoffice');
    }

    public function addProduct()
    {
        return view('add-product', [
            'categories' => Category::all()
        ]);
    }

    public function addCategory()
    {
        return view('add-category');
    }
}
