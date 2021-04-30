<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::get('/', [App\Http\Controllers\PagesController::class, 'home'])->name('home');

Route::get('/portal', [App\Http\Controllers\PagesController::class, 'portal'])->name('portal');

Route::get('/backoffice', [App\Http\Controllers\PagesController::class, 'backOffice'])->middleware('auth')->name('backoffice');


Route::resources([
    'products' => ProductController::class,
    'categories' => CategoryController::class
]);

Route::get('/cart', [App\Http\Controllers\CartController::class, 'show']);
Route::get('/cart/add/{product:id}', [App\Http\Controllers\CartController::class, 'addToCart']);
Route::get('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart']);
Route::get('/cart/remove/{product:id}/all', [App\Http\Controllers\CartController::class, 'removeAllOfItem']);
