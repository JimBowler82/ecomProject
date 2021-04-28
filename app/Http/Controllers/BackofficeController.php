<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function index()
    {
        return view('backoffice');
    }

    public function addProduct()
    {
        return view('add-product');
    }
}
