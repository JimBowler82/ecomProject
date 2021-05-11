<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function backOffice()
    {
        return view('backoffice', [
            'title' => 'Menu'
        ]);
    }
}
