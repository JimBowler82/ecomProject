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
    Route::get('/backoffice/addProduct', [App\Http\Controllers\BackofficeController::class, 'addProduct']);
    Route::get('/backoffice/addCategory', [App\Http\Controllers\BackofficeController::class, 'addCategory']);
    Route::post('/backoffice/addProduct', [App\Http\Controllers\ProductController::class, 'store']);
    Route::post('/backoffice/addCategory', [App\Http\Controllers\CategoryController::class, 'store']);
});



Route::get('/cart', [App\Http\Controllers\CartController::class, 'show']);

Route::get('/cart/add/{product:id}', [App\Http\Controllers\CartController::class, 'addToCart']);
Route::get('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart']);
Route::get('/cart/remove/{product:id}/all', [App\Http\Controllers\CartController::class, 'removeAllOfItem']);

Route::get('/{category:slug}', [App\Http\Controllers\HomeController::class, 'category']);

Route::get('/product/{product:id}', [App\Http\Controllers\HomeController::class, 'product']);
