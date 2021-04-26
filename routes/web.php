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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{category:slug}', [App\Http\Controllers\HomeController::class, 'category']);

Route::get('/product/{product:id}', [App\Http\Controllers\HomeController::class, 'product']);


Route::get('/portal', function () {
    return view('portal');
});

Route::get('/backoffice', function () {
    return view('backoffice');
})->middleware(['auth'])->name('backoffice');

require __DIR__.'/auth.php';
