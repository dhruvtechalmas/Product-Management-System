<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;



Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('welcome');


Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])
    ->name('add.to.cart');
    
Route::get('/cart', [CartController::class, 'cart'])
    ->name('cart');

Route::post('/cart-update', [CartController::class, 'cartUpdate'])
    ->name('cart.update');

Route::post('/order', [CartController::class, 'order'])
    ->middleware('auth')
    ->name('order.post');

Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])
    ->name('payment.success');

Route::get('/payment-cancel', [PaymentController::class, 'paymentCancel'])
    ->name('payment.cancel');

Route::get('/invoice/{id}', [InvoiceController::class, 'download'])
    ->name('invoice.download');

Route::get('/cart/increase/{id}', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::get('/cart/decrease/{id}', [CartController::class, 'decrease'])
    ->name('cart.decrease');

Route::get('/my-orders', [OrderController::class, 'myOrders'])
    ->middleware('auth')
    ->name('my.orders');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // MAIN DASHBOARD REDIRECT
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {
       return app(DashboardController::class)->index();
        }
        if (auth()->user()->hasRole('staff')) {
           return view('users.dashboard');
        }
        abort(403);
    })->name('dashboard');
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::post('/users/permission-update', [UserController::class, 'updatePermissions'])
        ->name('users.permission.update');

    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])
        ->name('users.delete');
});


Route::middleware(['auth'])->group(function () {

    // 🔹 PRODUCTS

    Route::get('product', [ProductController::class, 'index'])
        ->middleware(['auth', 'permission:product.view'])
        ->name('products.index');

    Route::get('product/create', [ProductController::class, 'create'])
        ->middleware('permission:product.create')->name('products.create');

    Route::post('product', [ProductController::class, 'store'])
        ->middleware('permission:product.create')->name('products.store');

    Route::get('product/{product}/edit', [ProductController::class, 'edit'])
        ->middleware('permission:product.edit')->name('products.edit');

    Route::put('product/{product}', [ProductController::class, 'update'])
        ->middleware('permission:product.edit')->name('products.update');

    Route::delete('product/{product}', [ProductController::class, 'destroy'])
        ->middleware('permission:product.delete')->name('products.destroy');

    Route::get('/product/pdf/{id}', [ProductController::class, 'exportSingle'])
        ->name('product.pdf.single')->middleware('auth');

    Route::get('/products/pdf', [ProductController::class, 'exportAll'])
        ->name('products.pdf')->middleware('auth');

    Route::get('/products/restore/{id}', [ProductController::class, 'restore'])
        ->name('products.restore');

    Route::get('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])
        ->name('products.forceDelete');



    // 🔹 CATEGORIES

    Route::get('category', [CategoryController::class, 'index'])
        ->middleware('permission:category.view')->name('categories.index');

    Route::get('category/create', [CategoryController::class, 'create'])
        ->middleware('permission:category.create')->name('categories.create');

    Route::post('category', [CategoryController::class, 'store'])
        ->middleware('permission:category.create')->name('categories.store');

    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])
        ->middleware('permission:category.edit')->name('categories.edit');

    Route::post('category/{category}', [CategoryController::class, 'update'])
        ->middleware('permission:category.edit')->name('categories.update');

    Route::post('/categories/delete/{id}', [CategoryController::class, 'deleteWithOption'])
        ->middleware('permission:category.delete')->name('categories.destroy');

});







