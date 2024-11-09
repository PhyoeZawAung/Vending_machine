<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('/admin')->group(function() {
        Route::prefix('/products')->group(function() {
            Route::get('/list', [ProductsController::class, 'index'])->name('products.list');
            Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
            Route::get('/edit/{product}', [ProductsCOntroller::class, 'edit'])->name('products.edit');
            Route::post('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
            Route::get('/delete/{id}', [ProductsController::class, 'destroy'])->name('products.delete');
        });
        Route::prefix('/users')->group(function() {
            Route::get('/list', [UsersController::class, 'index'])->name('users.list');
            Route::post('/store', [UsersController::class, 'store'])->name('users.store');
            Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');
            Route::post('/update/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::get('/delete/{id}', [UsersController::class, 'destroy'])->name('users.delete');
        });
    });

    Route::middleware('can:is-user')->group(function() {
        Route::get('/products',[ProductsController::class, 'index'])->name('products');
        Route::get('/products/{product}',[ProductsController::class, 'show'])->name('products.show');
        ROute::post('/product/buy', [ProductsController::class, 'buy'])->name('products.buy');
    });
});
