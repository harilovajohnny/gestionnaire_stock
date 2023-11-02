<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('hello');


Route::prefix('/product')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('product.index');
    Route::get('/new', 'create')->name('product.create');
    Route::post('/new', 'store');
    Route::get('/{id}/show', 'show')->name('product.show');
    Route::post('/{id}/show', 'update');
    Route::get('/{id}/delete', 'delete')->name('product.delete');
});

Route::prefix('/order')->controller(OrderController::class)->group(function () {
    Route::get('/', 'index')->name('order.index');
    Route::get('/{product}/new', 'create')->name('order.create');
    Route::post('/new', 'store')->name('order.store');;
    Route::get('/{id}/show', 'show')->name('order.show');
    Route::post('/{id}/show', 'update');
    Route::get('/{id}/delete', 'delete')->name('order.delete');

});

Route::prefix('/invoice')->controller(InvoiceController::class)->group(function () {
    Route::get('/', 'index')->name('invoice.index');
    Route::get('/new', 'create')->name('invoice.create');
    Route::post('/new', 'store');
    // Route::get('/{id}/show', 'show')->name('invoice.show');
    // Route::post('/{id}/show', 'update');
    // Route::get('/{id}/delete', 'delete')->name('invoice.delete');
});
