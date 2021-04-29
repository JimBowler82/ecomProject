<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/portal', [App\Http\Controllers\HomeController::class, 'portal'])->name('portal');

Route::middleware('auth')->group(function () {
    Route::get('/backoffice', [App\Http\Controllers\BackofficeController::class, 'index'])->name('backoffice');
    Route::get('/backoffice/productManager', [App\Http\Controllers\BackofficeController::class, 'productManager']);
    Route::get('/backoffice/categoryManager', [App\Http\Controllers\BackofficeController::class, 'categoryManager']);
    Route::get('/backoffice/addProduct', [App\Http\Controllers\BackofficeController::class, 'addProduct']);
    Route::get('/backoffice/addCategory', [App\Http\Controllers\BackofficeController::class, 'addCategory']);
    Route::get('/product/edit/{product:id}', [App\Http\Controllers\BackofficeController::class, 'productEdit']);
    Route::get('/category/edit/{category:id}', [App\Http\Controllers\BackofficeController::class, 'categoryEdit']);
    Route::post('/backoffice/addProduct', [App\Http\Controllers\ProductController::class, 'store']);
    Route::post('/backoffice/addCategory', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::patch('/product/edit/{product:id}', [App\Http\Controllers\ProductController::class, 'editProduct']);
    Route::patch('/category/edit/{category:id}', [App\Http\Controllers\CategoryController::class, 'editCategory']);
    Route::delete('/product/delete/{product:id}', [App\Http\Controllers\ProductController::class, 'delete']);
    Route::delete('/category/delete/{category:id}', [App\Http\Controllers\CategoryController::class, 'delete']);
});



Route::get('/cart', [App\Http\Controllers\CartController::class, 'show']);
Route::get('/cart/add/{product:id}', [App\Http\Controllers\CartController::class, 'addToCart']);
Route::get('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart']);
Route::get('/cart/remove/{product:id}/all', [App\Http\Controllers\CartController::class, 'removeAllOfItem']);

Route::get('/{category:slug}', [App\Http\Controllers\HomeController::class, 'category']);

Route::get('/product/{product:id}', [App\Http\Controllers\HomeController::class, 'product']);
