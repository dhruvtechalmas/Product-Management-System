<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('product', [ProductController::class,  'index'])->name('products.index');
Route::get('product/create', [ProductController::class,  'create'])->name('products.create');
Route::post('product', [ProductController::class,  'store'])->name('products.store');


Route::get('category', [CategoryController::class, 'index'])->name('categories.index');
Route::get('category/create', [CategoryController::class,  'create'])->name('categories.create');
Route::post('category', [CategoryController::class,  'store'])->name('categories.store');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
