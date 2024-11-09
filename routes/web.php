<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/generate/token', function(Request $request){
        $user = Auth::user();
        return $user->createToken('token',[$user->role==0?'user':'admin'])->plainTextToken;
    });
    Route::prefix('admin')->middleware('can:is-admin')->group(function() {
        Route::prefix('/products')->group(function() {
            Route::get('/list', [ProductsController::class, 'index'])->name('products.list');
            Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
            Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
            Route::get('/edit/{product}', [ProductsCOntroller::class, 'edit'])->name('products.edit');
            Route::post('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
            Route::get('/delete/{id}', [ProductsController::class, 'destroy'])->name('products.delete');
        });
        Route::prefix('/users')->group(function() {
            Route::get('/list', [UsersController::class, 'index'])->name('users.list');
            Route::get('/create', [UsersController::class, 'create'])->name('users.create');
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

require __DIR__ . '/auth.php';
