<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypesController;
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
require __DIR__ . '/auth.php';

Route::get('/', [App\Http\Controllers\PagesController::class, 'home'])->name('home');

Route::resources([
    'products' => ProductController::class,
    'categories' => CategoryController::class,
]);

Route::resource('productTypes', ProductTypesController::class)->except(['show']);

Route::get('/backoffice', [App\Http\Controllers\PagesController::class, 'backOffice'])->middleware('auth')->name('backoffice');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'show']);
Route::get('/cart/add/{product:id}', [App\Http\Controllers\CartController::class, 'add']);
Route::get('/cart/remove/{product:id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::get('/cart/remove/{product:id}/all', [App\Http\Controllers\CartController::class, 'removeAll']);

Route::post('/create-checkout-session', [App\Http\Controllers\CheckoutController::class, 'index']);
Route::post('/checkout/event', [App\Http\Controllers\CheckoutController::class, 'store']);
Route::get('/checkout/success', [App\Http\Controllers\CheckoutController::class, 'show']);

Route::get('/{categories}', [App\Http\Controllers\CategoryController::class, 'destructureCategoryFromSlug'])->where('categories', '.*');
