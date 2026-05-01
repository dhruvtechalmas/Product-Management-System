<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Route::get('/', function() {
    return view('welcome');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('product/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('product', [ProductController::class, 'store'])->name('products.store');
    Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('product/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('product/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('product/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');


    Route::get('category', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('category', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('category/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('category/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/category/pdf/{id}', [ProductController::class, 'exportCategory'])->name('category.pdf');


});



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');    
    Route::get('product', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
    Route::get('/product/pdf/{id}', [ProductController::class, 'exportSingle'])->name('product.pdf.single')->middleware('auth');
    Route::get('/products/pdf', [ProductController::class, 'exportAll'])->name('products.pdf')->middleware('auth');


